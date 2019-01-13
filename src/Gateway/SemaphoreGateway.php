<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 10.01.19
 * Time: 17:44
 */

namespace Boruta\BitcoinVanity\Gateway;

use Boruta\BitcoinVanity\Config\DatabaseConfig;
use Boruta\BitcoinVanity\Mapper\SemaphoreEntityMapper;
use PDO;


/**
 * Class SemaphoreGateway
 * @package Boruta\BitcoinVanity\Gateway
 */
class SemaphoreGateway extends AbstractDatabaseGateway
{
    /**
     * @var string
     */
    protected $instanceId;

    /**
     * SemaphoreGateway constructor.
     * @param DatabaseConfig $databaseConfig
     */
    public function __construct(DatabaseConfig $databaseConfig)
    {
        parent::__construct($databaseConfig);
        $this->instanceId = sha1(uniqid('semaphore', true));
    }

    /**
     * @param string $type
     * @return int|null
     */
    public function increment(string $type): ?int
    {
        $queryUpdate = 'UPDATE ' . SemaphoreEntityMapper::TABLE . ' SET ' . SemaphoreEntityMapper::FIELD_LOCKED_ID .
            ' = ' . SemaphoreEntityMapper::FIELD_LOCKED_ID . ' + 1, ' . SemaphoreEntityMapper::FIELD_INSTANCE . ' = :' .
            SemaphoreEntityMapper::FIELD_INSTANCE . ' WHERE ' . SemaphoreEntityMapper::FIELD_TYPE . ' = :' .
            SemaphoreEntityMapper::FIELD_TYPE . ' ORDER BY ' . SemaphoreEntityMapper::FIELD_LOCKED_ID . ' DESC LIMIT 1';

        $querySelect = 'SELECT ' . SemaphoreEntityMapper::FIELD_LOCKED_ID . ' FROM ' . SemaphoreEntityMapper::TABLE .
            ' WHERE ' . SemaphoreEntityMapper::FIELD_INSTANCE . ' = :' . SemaphoreEntityMapper::FIELD_INSTANCE .
            ' AND ' . SemaphoreEntityMapper::FIELD_TYPE . ' = :' . SemaphoreEntityMapper::FIELD_TYPE . ' ORDER BY ' .
            SemaphoreEntityMapper::FIELD_LOCKED_ID . ' DESC LIMIT 1';

        $this->database()->beginTransaction();

        $stmt = $this->database()->prepare($queryUpdate);
        $stmt->bindValue(':' . SemaphoreEntityMapper::FIELD_INSTANCE, $this->instanceId, PDO::PARAM_STR);
        $stmt->bindValue(':' . SemaphoreEntityMapper::FIELD_TYPE, $type, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            $this->database()->rollBack();
            return null;
        }

        $stmt = $this->database()->prepare($querySelect);
        $stmt->bindValue(':' . SemaphoreEntityMapper::FIELD_INSTANCE, $this->instanceId, PDO::PARAM_STR);
        $stmt->bindValue(':' . SemaphoreEntityMapper::FIELD_TYPE, $type, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            $this->database()->rollBack();
            return null;
        }

        $result = $stmt->fetch();

        if (($lockedId = (int)$result[SemaphoreEntityMapper::FIELD_LOCKED_ID]) <= 0) {
            $this->database()->rollBack();
            return null;
        }

        $this->database()->commit();
        return $lockedId;
    }
}