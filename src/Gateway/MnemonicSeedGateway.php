<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 11.12.18
 * Time: 17:19
 */

namespace Boruta\BitcoinVanity\Gateway;


use Boruta\BitcoinVanity\Mapper\MnemonicSeedEntityMapper;

/**
 * Class MnemonicSeedGateway
 * @package Boruta\BitcoinVanity\Gateway
 */
class MnemonicSeedGateway extends AbstractDatabaseGateway
{
    /**
     * @param array $data
     * @return int|null
     */
    public function addNewMnemonicSeed(array $data): ?int
    {
        return $this->insert($data, MnemonicSeedEntityMapper::TABLE);
    }
}
