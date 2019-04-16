<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
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
