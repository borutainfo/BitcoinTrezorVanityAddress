<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 08.01.19
 * Time: 17:10
 */

namespace Boruta\BitcoinVanity\Gateway;


use Boruta\BitcoinVanity\Mapper\AddressWordEntityMapper;

/**
 * Class AddressWordGateway
 * @package Boruta\BitcoinVanity\Gateway
 */
class AddressWordGateway extends AbstractDatabaseGateway
{
    /**
     * @param array $data
     * @return int|null
     */
    public function addNewAddressWord(array $data): ?int
    {
        return $this->insert($data, AddressWordEntityMapper::TABLE, true);
    }

    /**
     * @return array|null
     */
    public function getNewestAddressWord(): ?array
    {
        $condition = 'TRUE ORDER BY ' . AddressWordEntityMapper::FIELD_ADDRESS_ID . ' DESC';
        return $this->getSingleDataByCondition($condition, AddressWordEntityMapper::TABLE);
    }
}
