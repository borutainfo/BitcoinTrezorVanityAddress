<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Gateway;


use Boruta\BitcoinVanity\Mapper\SemaphoreEntityMapper;
use Boruta\CommonAbstraction\Config\MySQLConfig;
use Boruta\CommonAbstraction\Gateway\MySQLGatewayAbstract;

/**
 * Class SemaphoreGateway
 * @package Boruta\BitcoinVanity\Gateway
 */
class SemaphoreGateway extends MySQLGatewayAbstract
{
    /**
     * @var string
     */
    protected $instanceId;

    /**
     * SemaphoreGateway constructor.
     * @param MySQLConfig $databaseConfig
     */
    public function __construct(MySQLConfig $databaseConfig)
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
        $stmt->bindValue(':' . SemaphoreEntityMapper::FIELD_INSTANCE, $this->instanceId);
        $stmt->bindValue(':' . SemaphoreEntityMapper::FIELD_TYPE, $type);

        if (!$stmt->execute()) {
            $this->database()->rollBack();
            return null;
        }

        $stmt = $this->database()->prepare($querySelect);
        $stmt->bindValue(':' . SemaphoreEntityMapper::FIELD_INSTANCE, $this->instanceId);
        $stmt->bindValue(':' . SemaphoreEntityMapper::FIELD_TYPE, $type);

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
