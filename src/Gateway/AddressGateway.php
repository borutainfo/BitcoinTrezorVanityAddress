<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Gateway;


use Boruta\BitcoinVanity\Mapper\AddressEntityMapper;
use Boruta\CommonAbstraction\Gateway\AbstractDatabaseGateway;

/**
 * Class AddressGateway
 * @package Boruta\BitcoinVanity\Gateway
 */
class AddressGateway extends AbstractDatabaseGateway
{
    /**
     * @param array $data
     * @return int|null
     */
    public function addNewAddress(array $data): ?int
    {
        return $this->insert($data, AddressEntityMapper::TABLE);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function addMultipleAddress(array $data): bool
    {
        return $this->insertMultiple($data, AddressEntityMapper::TABLE);
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function getAddressById(int $id): ?array
    {
        return $this->getSingleDataByUnique(AddressEntityMapper::FIELD_ID, (string)$id, AddressEntityMapper::TABLE);
    }

    /**
     * @return array|null
     */
    public function getNewestAddress(): ?array
    {
        $condition = 'TRUE ORDER BY ' . AddressEntityMapper::FIELD_ID . ' DESC';
        return $this->getSingleDataByCondition($condition, AddressEntityMapper::TABLE);
    }
}
