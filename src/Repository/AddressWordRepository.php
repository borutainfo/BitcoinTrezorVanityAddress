<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Repository;

use Boruta\BitcoinVanity\Entity\AddressWordEntity;
use Boruta\BitcoinVanity\Exception\RepositoryException;
use Boruta\BitcoinVanity\Extractor\AddressWordEntityExtractor;
use Boruta\BitcoinVanity\Gateway\AddressWordGateway;
use Boruta\BitcoinVanity\Hydrator\AddressWordEntityHydrator;

/**
 * Class AddressWordRepository
 * @package Boruta\BitcoinVanity\Repository
 */
class AddressWordRepository
{
    /**
     * @var AddressWordGateway
     */
    protected $gateway;

    /**
     * AddressWordRepository constructor.
     * @param AddressWordGateway $gateway
     */
    public function __construct(AddressWordGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param AddressWordEntity $entity
     */
    public function addNewAddressWord(AddressWordEntity $entity): void
    {
        $extractor = new AddressWordEntityExtractor();
        $data = $extractor->extract($entity);

        $result = $this->gateway->addNewAddressWord($data);

        if ($result === null) {
            throw new RepositoryException('Unable to add new address-word junction entry - operation was unsuccessful.');
        }
    }

    /**
     * @return AddressWordEntity
     */
    public function getNewestAddressWord(): AddressWordEntity
    {
        $result = $this->gateway->getNewestAddressWord();
        if (!$result) {
            throw new RepositoryException('Unable to get newest address-word junction entry - operation was unsuccessful.');
        }

        $hydrator = new AddressWordEntityHydrator();
        return $hydrator->hydrate($result);
    }
}
