<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Gateway;


use Boruta\BitcoinVanity\Mapper\AddressWordEntityMapper;
use Boruta\CommonAbstraction\Gateway\MySQLGatewayAbstract;

/**
 * Class AddressWordGateway
 * @package Boruta\BitcoinVanity\Gateway
 */
class AddressWordGateway extends MySQLGatewayAbstract
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
