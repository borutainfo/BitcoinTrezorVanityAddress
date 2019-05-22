<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Repository;


use Boruta\CommonAbstraction\Exception\RepositoryException;
use Boruta\BitcoinVanity\Gateway\SemaphoreGateway;
use Boruta\CommonAbstraction\ValueObject\RawString;
use Boruta\CommonAbstraction\ValueObject\UnsignedNumber;

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
