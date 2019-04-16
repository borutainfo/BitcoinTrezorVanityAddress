<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

use BitWasp\Bitcoin\Crypto\Random\Random;
use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKeyFactory;
use BitWasp\Bitcoin\Mnemonic\Bip39\Bip39Mnemonic;
use BitWasp\Bitcoin\Mnemonic\Bip39\Bip39SeedGenerator;
use BitWasp\Bitcoin\Mnemonic\MnemonicFactory;
use Boruta\BitcoinVanity\Collection\AddressEntityCollection;
use Boruta\BitcoinVanity\Command\ConvertToAddressCommand;
use Boruta\BitcoinVanity\Command\EncryptDataCommand;
use Boruta\BitcoinVanity\DependencyInjection\DependencyInjection;
use Boruta\BitcoinVanity\Entity\AddressEntity;
use Boruta\BitcoinVanity\Entity\MnemonicSeedEntity;
use Boruta\BitcoinVanity\Entity\PrivateKeyEntity;
use Boruta\BitcoinVanity\Repository\AddressRepository;
use Boruta\BitcoinVanity\Repository\MnemonicSeedRepository;
use Boruta\BitcoinVanity\Repository\PrivateKeyRepository;
use Boruta\BitcoinVanity\ValueObject\DerivedPath;
use Boruta\BitcoinVanity\ValueObject\EntropySize;
use Boruta\BitcoinVanity\ValueObject\RawString;

/* config: */

$timeLimit = 2;
$entropySizeInBytes = 32;
$addressCountForSeed = 5;
$purposes = [44, 49, 84];

/* script: */

require __DIR__ . '/../vendor/autoload.php';

$startTime = time();
set_time_limit(($timeLimit * 60) + 30);
error_reporting(E_ALL & ~E_STRICT & ~E_WARNING & ~E_NOTICE);

echo 'Starting...' . PHP_EOL;

/** @var PrivateKeyRepository $privateKeyRepository */
$privateKeyRepository = DependencyInjection::get(PrivateKeyRepository::class);
/** @var MnemonicSeedRepository $mnemonicSeedRepository */
$mnemonicSeedRepository = DependencyInjection::get(MnemonicSeedRepository::class);
/** @var AddressRepository $addressRepository */
$addressRepository = DependencyInjection::get(AddressRepository::class);
/** @var ConvertToAddressCommand $convertToAddressCommand */
$convertToAddressCommand = DependencyInjection::get(ConvertToAddressCommand::class);
/** @var EncryptDataCommand $encryptDataCommand */
$encryptDataCommand = DependencyInjection::get(EncryptDataCommand::class);
/** @var Bip39Mnemonic $bip39 */
$bip39 = MnemonicFactory::bip39();
/** @var Bip39SeedGenerator $seedGenerator */
$seedGenerator = new Bip39SeedGenerator();

$counter = 0;

echo 'Working...' . PHP_EOL;

try {
    while (($startTime + ($timeLimit * 60)) > time()) {
        $random = new Random();
        $entropy = $random->bytes($entropySizeInBytes);
        $mnemonicSeed = $bip39->entropyToMnemonic($entropy);

        // save mnemonic seed to database
        $mnemonicSeedEntity = new MnemonicSeedEntity();
        $encryptedPhrase = $encryptDataCommand->execute(new RawString($mnemonicSeed));
        $mnemonicSeedEntity->setEncryptedPhrase($encryptedPhrase);
        $mnemonicSeedEntity->setEntropySize(new EntropySize($entropySizeInBytes * 8));
        $mnemonicSeedRepository->addNewMnemonicSeed($mnemonicSeedEntity);

        foreach ($purposes as $purpose) {

            $derivePathStart = $purpose . "'/0'/0'";
            $seed = $seedGenerator->getSeed($mnemonicSeed);
            $root = HierarchicalKeyFactory::fromEntropy($seed);
            $purposePriv = $root->derivePath($derivePathStart);
            $purposePub = $purposePriv->toExtendedPublicKey();
            $xpub = HierarchicalKeyFactory::fromExtended($purposePub);

            $addressEntityCollection = new AddressEntityCollection();

            for ($i = 0; $i < $addressCountForSeed; $i++) {
                $derivePathEnd = '0/' . $i;
                $privateKey = $purposePriv->derivePath($derivePathEnd)->getPrivateKey()->toWif();

                // save private key to database
                $privateKeyEntity = new PrivateKeyEntity();
                $encryptedPrivateKey = $encryptDataCommand->execute(new RawString($privateKey));
                $privateKeyEntity->setEncryptedPrivateKey($encryptedPrivateKey);
                $privateKeyRepository->addNewPrivateKey($privateKeyEntity);

                $address = $convertToAddressCommand->execute($xpub->derivePath($derivePathEnd), $purpose);
                $derivePath = 'm/' . $derivePathStart . '/' . $derivePathEnd;

                // save address to database
                $addressEntity = new AddressEntity();
                $addressEntity->setAddress($address);
                $addressEntity->setDerivedPath(new DerivedPath($derivePath));
                $addressEntity->setMnemonicId($mnemonicSeedEntity->getId());
                $addressEntity->setPrivateKeyId($privateKeyEntity->getId());

                $addressEntityCollection->push($addressEntity);
            }

            $addressRepository->addMultipleAddresses($addressEntityCollection);
        }

        $counter++;
    }
} catch (Throwable $exception) {
    $exceptionDetails = [
        'exceptionType' => get_class($exception),
        'exceptionMessage' => $exception->getMessage(),
        'exceptionTrace' => $exception->getTraceAsString()
    ];
    echo implode(PHP_EOL, $exceptionDetails) . PHP_EOL;
}

echo 'Stopping...' . PHP_EOL;
echo 'Counter: ' . $counter . PHP_EOL;
exit('Total execution time: ' . (time() - $startTime) . ' seconds. Bye.' . PHP_EOL);
