<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 09.12.18
 * Time: 15:10
 */

namespace Boruta\BitcoinVanity\Hydrator;

use Boruta\BitcoinVanity\Entity\MnemonicSeedEntity;
use Boruta\BitcoinVanity\Exception\ValueObjectException;
use Boruta\BitcoinVanity\Mapper\MnemonicSeedEntityMapper;
use Boruta\BitcoinVanity\ValueObject\EntropySize;
use Boruta\BitcoinVanity\ValueObject\RawString;
use Boruta\BitcoinVanity\ValueObject\UnsignedNumber;


/**
 * Class MnemonicSeedEntityHydrator
 * @package Boruta\BitcoinVanity\Hydrator
 */
class MnemonicSeedEntityHydrator
{
    /**
     * @param array $data
     * @param MnemonicSeedEntity $entity
     * @return MnemonicSeedEntity
     * @throws ValueObjectException
     */
    public function hydrate(array $data, MnemonicSeedEntity $entity = null): MnemonicSeedEntity
    {
        if (!$entity instanceof MnemonicSeedEntity) {
            $entity = new MnemonicSeedEntity();
        }

        if (isset($data[MnemonicSeedEntityMapper::FIELD_ID])) {
            $entity->setId(new UnsignedNumber($data[MnemonicSeedEntityMapper::FIELD_ID]));
        }

        if (isset($data[MnemonicSeedEntityMapper::FIELD_ENCRYPTED_PHRASE])) {
            $entity->setEncryptedPhrase(new RawString($data[MnemonicSeedEntityMapper::FIELD_ENCRYPTED_PHRASE]));
        }

        if (isset($data[MnemonicSeedEntityMapper::FIELD_ENTROPY_SIZE])) {
            $entity->setEntropySize(new EntropySize($data[MnemonicSeedEntityMapper::FIELD_ENTROPY_SIZE]));
        }

        return $entity;
    }
}
