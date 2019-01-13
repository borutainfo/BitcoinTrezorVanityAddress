<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 09.12.18
 * Time: 14:55
 */

namespace Boruta\BitcoinVanity\Extractor;


use Boruta\BitcoinVanity\Entity\PrivateKeyEntity;
use Boruta\BitcoinVanity\Mapper\PrivateKeyEntityMapper;
use Boruta\BitcoinVanity\ValueObject\ValueObjectInterface;

/**
 * Class PrivateKeyEntityExtractor
 * @package Boruta\BitcoinVanity\Extractor
 */
class PrivateKeyEntityExtractor
{
    /**
     * @param PrivateKeyEntity $entity
     * @return array
     */
    public function extract(PrivateKeyEntity $entity): array
    {
        $data = [];

        if (($field = $entity->getId()) instanceof ValueObjectInterface) {
            $data[PrivateKeyEntityMapper::FIELD_ID] = $field->value();
        }

        if (($field = $entity->getEncryptedPrivateKey()) instanceof ValueObjectInterface) {
            $data[PrivateKeyEntityMapper::FIELD_ENCRYPTED_PRIVATE_KEY] = $field->value();
        }

        return $data;
    }
}
