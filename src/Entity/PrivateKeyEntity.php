<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Entity;


use Boruta\CommonAbstraction\ValueObject\RawString;
use Boruta\CommonAbstraction\ValueObject\UnsignedNumber;

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
