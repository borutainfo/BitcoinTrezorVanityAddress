<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Extractor;


use Boruta\BitcoinVanity\Entity\AddressEntity;
use Boruta\BitcoinVanity\Mapper\AddressEntityMapper;
use Boruta\BitcoinVanity\ValueObject\ValueObjectInterface;

/**
 * Class AddressEntityExtractor
 * @package Boruta\BitcoinVanity\Extractor
 */
class AddressEntityExtractor
{
    /**
     * @param AddressEntity $entity
     * @return array
     */
    public function extract(AddressEntity $entity): array
    {
        $data = [];

        if (($field = $entity->getId()) instanceof ValueObjectInterface) {
            $data[AddressEntityMapper::FIELD_ID] = $field->value();
        }

        if (($field = $entity->getAddress()) instanceof ValueObjectInterface) {
            $data[AddressEntityMapper::FIELD_ADDRESS] = $field->value();
        }

        if (($field = $entity->getDerivedPath()) instanceof ValueObjectInterface) {
            $data[AddressEntityMapper::FIELD_DERIVED_PATH] = $field->value();
        }

        if (($field = $entity->getMnemonicId()) instanceof ValueObjectInterface) {
            $data[AddressEntityMapper::FIELD_MNEMONIC_ID] = $field->value();
        }

        if (($field = $entity->getPrivateKeyId()) instanceof ValueObjectInterface) {
            $data[AddressEntityMapper::FIELD_PRIVATE_KEY_ID] = $field->value();
        }

        return $data;
    }
}
