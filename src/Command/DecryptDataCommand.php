<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Command;


use Boruta\BitcoinVanity\Config\EncryptionConfig;
use Boruta\BitcoinVanity\Exception\EncryptionException;
use Boruta\BitcoinVanity\Exception\ValueObjectException;
use Boruta\BitcoinVanity\ValueObject\RawString;

/**
 * Class DecryptDataCommand
 * @package Boruta\BitcoinVanity\Command
 */
class DecryptDataCommand
{
    /**
     * @var EncryptionConfig
     */
    protected $encryptionConfig;

    /**
     * DecryptDataCommand constructor.
     * @param $encryptionConfig
     */
    public function __construct(EncryptionConfig $encryptionConfig)
    {
        $this->encryptionConfig = $encryptionConfig;
    }

    /**
     * @param RawString $data
     * @return RawString
     * @throws EncryptionException
     */
    public function execute(RawString $data): RawString
    {
        /** @noinspection EncryptionInitializationVectorRandomnessInspection */
        $decryptedString = openssl_decrypt($data->value(), $this->encryptionConfig->getCipher(),
            $this->encryptionConfig->getPassword());

        if ($decryptedString === false) {
            throw new EncryptionException('Unable to decrypt data!');
        }

        try {
            return new RawString($decryptedString);
        } catch (ValueObjectException $exception) {
            throw new EncryptionException('Invalid format of decrypted data!');
        }
    }
}
