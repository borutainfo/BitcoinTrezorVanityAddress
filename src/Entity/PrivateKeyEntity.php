<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 09.12.18
 * Time: 14:52
 */

namespace Boruta\BitcoinVanity\Entity;

use Boruta\BitcoinVanity\ValueObject\RawString;
use Boruta\BitcoinVanity\ValueObject\UnsignedNumber;


/**
 * Class PrivateKeyEntity
 * @package Boruta\BitcoinVanity\Entity
 */
class PrivateKeyEntity
{
    /**
     * @var UnsignedNumber
     */
    protected $id;
    /**
     * @var RawString
     */
    protected $encryptedPrivateKey;

    /**
     * @return UnsignedNumber|null
     */
    public function getId(): ?UnsignedNumber
    {
        return $this->id;
    }

    /**
     * @param UnsignedNumber $id
     */
    public function setId(UnsignedNumber $id): void
    {
        $this->id = $id;
    }

    /**
     * @return RawString|null
     */
    public function getEncryptedPrivateKey(): ?RawString
    {
        return $this->encryptedPrivateKey;
    }

    /**
     * @param RawString $encryptedPrivateKey
     */
    public function setEncryptedPrivateKey(RawString $encryptedPrivateKey): void
    {
        $this->encryptedPrivateKey = $encryptedPrivateKey;
    }
}
