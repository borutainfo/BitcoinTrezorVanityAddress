<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Config;


use Boruta\BitcoinVanity\Exception\DatabaseConfigException;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

/**
 * Class DatabaseConfig
 * @package Boruta\BitcoinVanity\Config
 */
class DatabaseConfig
{
    /**
     * @var string
     */
    private $host;
    /**
     * @var string
     */
    private $login;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $database;
    /**
     * @var int
     */
    private $port;

    /**
     * DatabaseConfig constructor.
     * @throws DatabaseConfigException
     */
    public function __construct()
    {
        try {
            $configData = Yaml::parseFile(__DIR__ . '/../../config/database.yml');
        } catch (ParseException $exception) {
            throw new DatabaseConfigException('Unable to parse database config file!');
        }

        if (!isset($configData['host'], $configData['login'], $configData['password'], $configData['database'])) {
            throw new DatabaseConfigException('Database config not contains all fields!');
        }

        $this->host = (string)$configData['host'];
        $this->login = (string)$configData['login'];
        $this->password = (string)$configData['password'];
        $this->database = (string)$configData['database'];
        $this->port = isset($configData['port']) ? (int)$configData['port'] : 3306;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getDatabase(): string
    {
        return $this->database;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }
}
