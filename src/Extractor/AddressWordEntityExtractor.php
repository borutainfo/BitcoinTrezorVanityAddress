<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Extractor;


use Boruta\BitcoinVanity\Entity\AddressWordEntity;
use Boruta\BitcoinVanity\Mapper\AddressWordEntityMapper;
use Boruta\BitcoinVanity\ValueObject\ValueObjectInterface;

/**
 * Class AddressWordEntityExtractor
 * @package Boruta\BitcoinVanity\Extractor
 */
class AddressWordEntityExtractor
{
    /**
     * @param AddressWordEntity $entity
     * @return array
     */
    public function extract(AddressWordEntity $entity): array
    {
        $data = [];

        if (($field = $entity->getAddressId()) instanceof ValueObjectInterface) {
            $data[AddressWordEntityMapper::FIELD_ADDRESS_ID] = $field->value();
        }

        if (($field = $entity->getWordId()) instanceof ValueObjectInterface) {
            $data[AddressWordEntityMapper::FIELD_WORD_ID] = $field->value();
        }

        return $data;
    }
}
