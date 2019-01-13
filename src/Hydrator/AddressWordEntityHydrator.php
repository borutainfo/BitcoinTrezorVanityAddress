<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 08.01.19
 * Time: 17:02
 */

namespace Boruta\BitcoinVanity\Hydrator;


use Boruta\BitcoinVanity\Entity\AddressWordEntity;
use Boruta\BitcoinVanity\Exception\ValueObjectException;
use Boruta\BitcoinVanity\Mapper\AddressWordEntityMapper;
use Boruta\BitcoinVanity\ValueObject\UnsignedNumber;

/**
 * Class AddressWordEntityHydrator
 * @package Boruta\BitcoinVanity\Hydrator
 */
class AddressWordEntityHydrator
{
    /**
     * @param array $data
     * @param AddressWordEntity $entity
     * @return AddressWordEntity
     * @throws ValueObjectException
     */
    public function hydrate(array $data, AddressWordEntity $entity = null): AddressWordEntity
    {
        if (!$entity instanceof AddressWordEntity) {
            $entity = new AddressWordEntity();
        }

        if (isset($data[AddressWordEntityMapper::FIELD_WORD_ID])) {
            $entity->setAddressId(new UnsignedNumber($data[AddressWordEntityMapper::FIELD_WORD_ID]));
        }

        if (isset($data[AddressWordEntityMapper::FIELD_ADDRESS_ID])) {
            $entity->setWordId(new UnsignedNumber($data[AddressWordEntityMapper::FIELD_ADDRESS_ID]));
        }

        return $entity;
    }
}
