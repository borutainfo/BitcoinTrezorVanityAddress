<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

use Boruta\CommonAbstraction\Config\DatabaseConfig;
use Boruta\CommonAbstraction\DependencyInjector\DependencyInjector;
use Boruta\BitcoinVanity\Entity\AddressWordEntity;
use Boruta\BitcoinVanity\Entity\WordEntity;
use Boruta\CommonAbstraction\Exception\RepositoryException;
use Boruta\CommonAbstraction\Exception\ValueObjectException;
use Boruta\BitcoinVanity\Repository\AddressRepository;
use Boruta\BitcoinVanity\Repository\AddressWordRepository;
use Boruta\BitcoinVanity\Repository\SemaphoreRepository;
use Boruta\BitcoinVanity\Repository\WordRepository;
use Boruta\CommonAbstraction\ValueObject\RawString;
use Boruta\CommonAbstraction\ValueObject\UnsignedNumber;
use Boruta\BitcoinVanity\ValueObject\Word;

/* config: */

$timeLimit = 2;
$dictionariesLocation = __DIR__ . '/../config/dictionaries/';
$semaphoreType = 'word';

/* script: */

require __DIR__ . '/../vendor/autoload.php';

$startTime = time();
set_time_limit($timeLimit * 60 + 30);
error_reporting(E_ALL & ~E_STRICT & ~E_WARNING & ~E_NOTICE);

echo 'Starting...' . PHP_EOL;

DependencyInjector::set(DatabaseConfig::class, function () {
    return new DatabaseConfig(__DIR__ . '/../config/database.yml');
});

/** @var AddressRepository $addressRepository */
$addressRepository = DependencyInjector::get(AddressRepository::class);
/** @var AddressWordRepository $addressWordRepository */
$addressWordRepository = DependencyInjector::get(AddressWordRepository::class);
/** @var WordRepository $wordRepository */
$wordRepository = DependencyInjector::get(WordRepository::class);
/** @var SemaphoreRepository $semaphoreRepository */
$semaphoreRepository = DependencyInjector::get(SemaphoreRepository::class);

$dictionaries = '';
$directory = opendir($dictionariesLocation);
while ($filename = readdir($directory)) {
    $dictionaries .= file_get_contents($dictionariesLocation . $filename);
}

$words = [];
foreach (explode(PHP_EOL, $dictionaries) as $word) {
    try {
        $words[] = Word::createFromString($word)->value();
    } catch (ValueObjectException $exception) {
        continue;
    }
}

sort($words);
$words = array_unique($words);

unlink($dictionaries, $directory);
$counter = 0;

echo 'Working...' . PHP_EOL;

try {
    $semaphoreType = new RawString($semaphoreType);
    $limit = $addressRepository->getNewestAddressId()->value();

    while (($startTime + ($timeLimit * 60)) > time()) {
        try {
            $lockedId = $semaphoreRepository->increment($semaphoreType);
            $addressEntity = $addressRepository->getAddressById($lockedId);
            $address = strtolower($addressEntity->getAddress()->value());

            foreach ($words as $word) {
                if (strpos($address, $word) !== false) {
                    $wordEntity = new WordEntity();
                    $wordEntity->setWord(new Word($word));
                    $wordEntity->setValue(new UnsignedNumber(strlen($word)));
                    $wordRepository->addNewWord($wordEntity);

                    $addressWordEntity = new AddressWordEntity();
                    $addressWordEntity->setWordId($wordEntity->getId());
                    $addressWordEntity->setAddressId($addressEntity->getId());
                    $addressWordRepository->addNewAddressWord($addressWordEntity);
                }
            }

            $counter++;

            if($lockedId->value() >= $limit) {
                break;
            }
        } catch (RepositoryException $ignored) {
        }
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
