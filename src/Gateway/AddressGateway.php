<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 11.12.18
 * Time: 17:20
 */

namespace Boruta\BitcoinVanity\Gateway;


use Boruta\BitcoinVanity\Mapper\AddressEntityMapper;

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
