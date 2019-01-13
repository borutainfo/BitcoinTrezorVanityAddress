<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 10.12.18
 * Time: 20:51
 */

namespace Boruta\BitcoinVanity\Gateway;


use Boruta\BitcoinVanity\Mapper\PrivateKeyEntityMapper;

/**
 * Class PrivateKeyGateway
 * @package Boruta\BitcoinVanity\Gateway
 */
class PrivateKeyGateway extends AbstractDatabaseGateway
{
    /**
     * @param array $data
     * @return int|null
     */
    public function addNewPrivateKey(array $data): ?int
    {
        return $this->insert($data, PrivateKeyEntityMapper::TABLE);
    }
}
