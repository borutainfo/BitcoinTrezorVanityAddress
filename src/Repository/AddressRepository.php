<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Repository;


use Boruta\BitcoinVanity\Collection\AddressEntityCollection;
use Boruta\BitcoinVanity\Entity\AddressEntity;
use Boruta\BitcoinVanity\Exception\RepositoryException;
use Boruta\BitcoinVanity\Extractor\AddressEntityExtractor;
use Boruta\BitcoinVanity\Gateway\AddressGateway;
use Boruta\BitcoinVanity\Hydrator\AddressEntityHydrator;
use Boruta\BitcoinVanity\Mapper\AddressEntityMapper;
use Boruta\BitcoinVanity\ValueObject\UnsignedNumber;

/**
 * Class AddressRepository
 * @package Boruta\BitcoinVanity\Repository
 */
class AddressRepository
{
    /**
     * @var AddressGateway
     */
    protected $gateway;

    /**
     * AddressRepository constructor.
     * @param AddressGateway $gateway
     */
    public function __construct(AddressGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param AddressEntity $entity
     */
    public function addNewAddress(AddressEntity $entity): void
    {
        $extractor = new AddressEntityExtractor();
        $data = $extractor->extract($entity);

        $result = $this->gateway->addNewAddress($data);

        if (!$result) {
            throw new RepositoryException('Unable to add new address - operation was unsuccessful.');
        }

        $entity->setId(new UnsignedNumber($result));
    }

    /**
     * @param AddressEntityCollection $collection
     */
    public function addMultipleAddresses(AddressEntityCollection $collection): void
    {
        $data = [];
        $extractor = new AddressEntityExtractor();

        /** @var AddressEntity $entity */
        foreach ($collection as $entity) {
            $data[] = $extractor->extract($entity);
        }

        if (!$this->gateway->addMultipleAddress($data)) {
            throw new RepositoryException('Unable to add multiple address - operation was unsuccessful.');
        }
    }

    /**
     * @param UnsignedNumber $id
     * @return AddressEntity
     */
    public function getAddressById(UnsignedNumber $id): AddressEntity
    {
        $result = $this->gateway->getAddressById($id->value());

        if (!$result) {
            throw new RepositoryException('Unable to find address - operation was unsuccessful.');
        }

        $hydrator = new AddressEntityHydrator();
        return $hydrator->hydrate($result);
    }

    /**
     * @return UnsignedNumber
     */
    public function getNewestAddressId(): UnsignedNumber
    {
        $result = $this->gateway->getNewestAddress();

        if (!$result) {
            throw new RepositoryException('Unable to get newest address information - operation was unsuccessful.');
        }

        return new UnsignedNumber($result[AddressEntityMapper::FIELD_ID]);
    }
}
