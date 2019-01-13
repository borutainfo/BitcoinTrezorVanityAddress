<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 07.01.19
 * Time: 21:08
 */

namespace Boruta\BitcoinVanity\Gateway;


use Boruta\BitcoinVanity\Mapper\WordEntityMapper;

/**
 * Class WordGateway
 * @package Boruta\BitcoinVanity\Gateway
 */
class WordGateway extends AbstractDatabaseGateway
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
