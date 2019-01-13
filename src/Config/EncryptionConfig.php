<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 09.12.18
 * Time: 14:23
 */

namespace Boruta\BitcoinVanity\Config;


use Boruta\BitcoinVanity\Exception\EncryptionConfigException;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

/**
 * Class EncryptionConfig
 * @package Boruta\BitcoinVanity\Config
 */
class EncryptionConfig
{
    /**
     * @var string
     */
    private $cipher;
    /**
     * @var string
     */
    private $password;

    /**
     * EncryptionConfig constructor.
     * @throws EncryptionConfigException
     */
    public function __construct()
    {
        try {
            $configData = Yaml::parseFile(__DIR__ . '/../../config/encryption.yml');
        } catch (ParseException $exception) {
            throw new EncryptionConfigException('Unable to parse encryption config file!');
        }

        if (!isset($configData['cipher'], $configData['password'])) {
            throw new EncryptionConfigException('Encryption config not contains all fields!');
        }

        $this->cipher = (string)$configData['cipher'];
        $this->password = (string)$configData['password'];
    }

    /**
     * @return string
     */
    public function getCipher(): string
    {
        return $this->cipher;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
