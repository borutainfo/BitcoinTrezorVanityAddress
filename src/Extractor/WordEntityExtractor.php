<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 07.01.19
 * Time: 21:18
 */

namespace Boruta\BitcoinVanity\Extractor;


use Boruta\BitcoinVanity\Entity\WordEntity;
use Boruta\BitcoinVanity\Mapper\WordEntityMapper;
use Boruta\BitcoinVanity\ValueObject\ValueObjectInterface;

/**
 * Class WordEntityExtractor
 * @package Boruta\BitcoinVanity\Extractor
 */
class WordEntityExtractor
{
    /**
     * @param WordEntity $entity
     * @return array
     */
    public function extract(WordEntity $entity): array
    {
        $data = [];

        if (($field = $entity->getId()) instanceof ValueObjectInterface) {
            $data[WordEntityMapper::FIELD_ID] = $field->value();
        }

        if (($field = $entity->getWord()) instanceof ValueObjectInterface) {
            $data[WordEntityMapper::FIELD_WORD] = $field->value();
        }

        if (($field = $entity->getValue()) instanceof ValueObjectInterface) {
            $data[WordEntityMapper::FIELD_VALUE] = $field->value();
        }

        return $data;
    }
}
