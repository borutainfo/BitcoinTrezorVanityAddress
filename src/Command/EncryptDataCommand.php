<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 09.12.18
 * Time: 14:21
 */

namespace Boruta\BitcoinVanity\Command;


use Boruta\BitcoinVanity\Config\EncryptionConfig;
use Boruta\BitcoinVanity\Exception\EncryptionException;
use Boruta\BitcoinVanity\Exception\ValueObjectException;
use Boruta\BitcoinVanity\ValueObject\RawString;

/**
 * Class EncryptDataCommand
 * @package Boruta\BitcoinVanity\Command
 */
class EncryptDataCommand
{
    /**
     * @var EncryptionConfig
     */
    protected $encryptionConfig;

    /**
     * EncryptDataCommand constructor.
     * @param EncryptionConfig $encryptionConfig
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
        $encryptedString = openssl_encrypt($data->value(), $this->encryptionConfig->getCipher(),
            $this->encryptionConfig->getPassword());

        if ($encryptedString === false) {
            throw new EncryptionException('Unable to encrypt data!');
        }

        try {
            return new RawString($encryptedString);
        } catch (ValueObjectException $exception) {
            throw new EncryptionException('Invalid format of encrypted data!');
        }
    }
}
