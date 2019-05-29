<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Gateway;


use Boruta\BitcoinVanity\Mapper\WordEntityMapper;
use Boruta\CommonAbstraction\Gateway\MySQLGatewayAbstract;

/**
 * Class WordGateway
 * @package Boruta\BitcoinVanity\Gateway
 */
class WordGateway extends MySQLGatewayAbstract
{
    /**
     * @param array $data
     * @return int|null
     */
    public function addNewWord(array $data): ?int
    {
        return $this->insert($data, WordEntityMapper::TABLE, true);
    }

    /**
     * @param string $word
     * @return array|null
     */
    public function getWord(string $word): ?array
    {
        return $this->getSingleDataByUnique(WordEntityMapper::FIELD_WORD, $word, WordEntityMapper::TABLE);
    }
}
