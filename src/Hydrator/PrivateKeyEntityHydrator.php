<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Hydrator;


use Boruta\BitcoinVanity\Entity\PrivateKeyEntity;
use Boruta\BitcoinVanity\Exception\ValueObjectException;
use Boruta\BitcoinVanity\Mapper\PrivateKeyEntityMapper;
use Boruta\BitcoinVanity\ValueObject\RawString;
use Boruta\BitcoinVanity\ValueObject\UnsignedNumber;

/**
 * Class PrivateKeyEntityHydrator
 * @package Boruta\BitcoinVanity\Hydrator
 */
class PrivateKeyEntityHydrator
{
    /**
     * @param array $data
     * @param PrivateKeyEntity $entity
     * @return PrivateKeyEntity
     * @throws ValueObjectException
     */
    public function hydrate(array $data, PrivateKeyEntity $entity = null): PrivateKeyEntity
    {
        if (!$entity instanceof PrivateKeyEntity) {
            $entity = new PrivateKeyEntity();
        }

        if (isset($data[PrivateKeyEntityMapper::FIELD_ID])) {
            $entity->setId(new UnsignedNumber($data[PrivateKeyEntityMapper::FIELD_ID]));
        }

        if (isset($data[PrivateKeyEntityMapper::FIELD_ENCRYPTED_PRIVATE_KEY])) {
            $entity->setEncryptedPrivateKey(new RawString($data[PrivateKeyEntityMapper::FIELD_ENCRYPTED_PRIVATE_KEY]));
        }

        return $entity;
    }
}
