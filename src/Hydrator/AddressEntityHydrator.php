<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 09.12.18
 * Time: 15:13
 */

namespace Boruta\BitcoinVanity\Hydrator;


use Boruta\BitcoinVanity\Entity\AddressEntity;
use Boruta\BitcoinVanity\Exception\ValueObjectException;
use Boruta\BitcoinVanity\Mapper\AddressEntityMapper;
use Boruta\BitcoinVanity\ValueObject\Address;
use Boruta\BitcoinVanity\ValueObject\DerivedPath;
use Boruta\BitcoinVanity\ValueObject\UnsignedNumber;

/**
 * Class AddressEntityHydrator
 * @package Boruta\BitcoinVanity\Hydrator
 */
class AddressEntityHydrator
{
    /**
     * @param array $data
     * @param AddressEntity $entity
     * @return AddressEntity
     * @throws ValueObjectException
     */
    public function hydrate(array $data, AddressEntity $entity = null): AddressEntity
    {
        if (!$entity instanceof AddressEntity) {
            $entity = new AddressEntity();
        }

        if (isset($data[AddressEntityMapper::FIELD_ID])) {
            $entity->setId(new UnsignedNumber($data[AddressEntityMapper::FIELD_ID]));
        }

        if (isset($data[AddressEntityMapper::FIELD_ADDRESS])) {
            $entity->setAddress(new Address($data[AddressEntityMapper::FIELD_ADDRESS]));
        }

        if (isset($data[AddressEntityMapper::FIELD_DERIVED_PATH])) {
            $entity->setDerivedPath(new DerivedPath($data[AddressEntityMapper::FIELD_DERIVED_PATH]));
        }

        if (isset($data[AddressEntityMapper::FIELD_MNEMONIC_ID])) {
            $entity->setMnemonicId(new UnsignedNumber($data[AddressEntityMapper::FIELD_MNEMONIC_ID]));
        }

        if (isset($data[AddressEntityMapper::FIELD_PRIVATE_KEY_ID])) {
            $entity->setPrivateKeyId(new UnsignedNumber($data[AddressEntityMapper::FIELD_PRIVATE_KEY_ID]));
        }

        return $entity;
    }
}
