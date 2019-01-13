<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 09.12.18
 * Time: 14:53
 */

namespace Boruta\BitcoinVanity\Entity;

use Boruta\BitcoinVanity\ValueObject\Address;
use Boruta\BitcoinVanity\ValueObject\DerivedPath;
use Boruta\BitcoinVanity\ValueObject\UnsignedNumber;


/**
 * Class AddressEntity
 * @package Boruta\BitcoinVanity\Entity
 */
class AddressEntity
{
    /**
     * @var UnsignedNumber
     */
    protected $id;
    /**
     * @var Address
     */
    protected $address;
    /**
     * @var DerivedPath
     */
    protected $derivedPath;
    /**
     * @var UnsignedNumber
     */
    protected $mnemonicId;
    /**
     * @var UnsignedNumber
     */
    protected $privateKeyId;

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
     * @return Address|null
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    /**
     * @return DerivedPath|null
     */
    public function getDerivedPath(): ?DerivedPath
    {
        return $this->derivedPath;
    }

    /**
     * @param DerivedPath $derivedPath
     */
    public function setDerivedPath(DerivedPath $derivedPath): void
    {
        $this->derivedPath = $derivedPath;
    }

    /**
     * @return UnsignedNumber|null
     */
    public function getMnemonicId(): ?UnsignedNumber
    {
        return $this->mnemonicId;
    }

    /**
     * @param UnsignedNumber $mnemonicId
     */
    public function setMnemonicId(UnsignedNumber $mnemonicId): void
    {
        $this->mnemonicId = $mnemonicId;
    }

    /**
     * @return UnsignedNumber|null
     */
    public function getPrivateKeyId(): ?UnsignedNumber
    {
        return $this->privateKeyId;
    }

    /**
     * @param UnsignedNumber $privateKeyId
     */
    public function setPrivateKeyId(UnsignedNumber $privateKeyId): void
    {
        $this->privateKeyId = $privateKeyId;
    }
}
