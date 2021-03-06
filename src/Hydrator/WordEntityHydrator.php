<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Hydrator;


use Boruta\BitcoinVanity\Entity\WordEntity;
use Boruta\CommonAbstraction\Exception\ValueObjectException;
use Boruta\BitcoinVanity\Mapper\WordEntityMapper;
use Boruta\CommonAbstraction\ValueObject\UnsignedNumber;
use Boruta\BitcoinVanity\ValueObject\Word;

/**
 * Class WordEntityHydrator
 * @package Boruta\BitcoinVanity\Hydrator
 */
class WordEntityHydrator
{
    /**
     * @param array $data
     * @param WordEntity $entity
     * @return WordEntity
     * @throws ValueObjectException
     */
    public function hydrate(array $data, WordEntity $entity = null): WordEntity
    {
        if (!$entity instanceof WordEntity) {
            $entity = new WordEntity();
        }

        if (isset($data[WordEntityMapper::FIELD_ID])) {
            $entity->setId(new UnsignedNumber($data[WordEntityMapper::FIELD_ID]));
        }

        if (isset($data[WordEntityMapper::FIELD_WORD])) {
            $entity->setWord(new Word($data[WordEntityMapper::FIELD_WORD]));
        }

        if (isset($data[WordEntityMapper::FIELD_VALUE])) {
            $entity->setValue(new UnsignedNumber($data[WordEntityMapper::FIELD_VALUE]));
        }

        return $entity;
    }
}
