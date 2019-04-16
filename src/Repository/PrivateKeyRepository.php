<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Repository;


use Boruta\BitcoinVanity\Entity\PrivateKeyEntity;
use Boruta\BitcoinVanity\Exception\RepositoryException;
use Boruta\BitcoinVanity\Extractor\PrivateKeyEntityExtractor;
use Boruta\BitcoinVanity\Gateway\PrivateKeyGateway;
use Boruta\BitcoinVanity\ValueObject\UnsignedNumber;

/**
 * Class PrivateKeyRepository
 * @package Boruta\BitcoinVanity\Repository
 */
class PrivateKeyRepository
{
    /**
     * @var PrivateKeyGateway
     */
    protected $gateway;

    /**
     * PrivateKeyRepository constructor.
     * @param PrivateKeyGateway $gateway
     */
    public function __construct(PrivateKeyGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param PrivateKeyEntity $entity
     */
    public function addNewPrivateKey(PrivateKeyEntity $entity): void
    {
        $extractor = new PrivateKeyEntityExtractor();
        $data = $extractor->extract($entity);

        $result = $this->gateway->addNewPrivateKey($data);

        if (!$result) {
            throw new RepositoryException('Unable to add new private key - operation was unsuccessful.');
        }

        $entity->setId(new UnsignedNumber($result));
    }
}
