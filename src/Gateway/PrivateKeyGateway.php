<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
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
