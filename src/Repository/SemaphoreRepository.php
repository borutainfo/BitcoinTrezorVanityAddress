<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 10.01.19
 * Time: 18:24
 */

namespace Boruta\BitcoinVanity\Repository;


use Boruta\BitcoinVanity\Exception\RepositoryException;
use Boruta\BitcoinVanity\Gateway\SemaphoreGateway;
use Boruta\BitcoinVanity\ValueObject\RawString;
use Boruta\BitcoinVanity\ValueObject\UnsignedNumber;

/**
 * Class SemaphoreRepository
 * @package Boruta\BitcoinVanity\Repository
 */
class SemaphoreRepository
{
    /**
     * @var SemaphoreGateway
     */
    protected $gateway;

    /**
     * SemaphoreRepository constructor.
     * @param SemaphoreGateway $gateway
     */
    public function __construct(SemaphoreGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param RawString $type
     * @return UnsignedNumber
     */
    public function increment(RawString $type): UnsignedNumber
    {
        $result = $this->gateway->increment($type->value());

        if (!$result) {
            throw new RepositoryException('Unable to execute semaphore - operation was unsuccessful.');
        }

        return new UnsignedNumber($result);
    }
}
