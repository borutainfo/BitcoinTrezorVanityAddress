<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Gateway;


use Boruta\BitcoinVanity\Mapper\MnemonicSeedEntityMapper;
use Boruta\CommonAbstraction\Gateway\MySQLGatewayAbstract;

/**
 * Class MnemonicSeedGateway
 * @package Boruta\BitcoinVanity\Gateway
 */
class MnemonicSeedGateway extends MySQLGatewayAbstract
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
