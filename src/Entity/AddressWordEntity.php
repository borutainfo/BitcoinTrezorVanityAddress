<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 07.01.19
 * Time: 21:11
 */

namespace Boruta\BitcoinVanity\Entity;

use Boruta\BitcoinVanity\ValueObject\UnsignedNumber;


/**
 * Class AddressWordEntity
 * @package Boruta\BitcoinVanity\Entity
 */
class AddressWordEntity
{
    /**
     * @var UnsignedNumber
     */
    protected $addressId;
    /**
     * @var UnsignedNumber
     */
    protected $wordId;

    /**
     * @return UnsignedNumber|null
     */
    public function getAddressId(): ?UnsignedNumber
    {
        return $this->addressId;
    }

    /**
     * @param UnsignedNumber $addressId
     */
    public function setAddressId(UnsignedNumber $addressId): void
    {
        $this->addressId = $addressId;
    }

    /**
     * @return UnsignedNumber|null
     */
    public function getWordId(): ?UnsignedNumber
    {
        return $this->wordId;
    }

    /**
     * @param UnsignedNumber $wordId
     */
    public function setWordId(UnsignedNumber $wordId): void
    {
        $this->wordId = $wordId;
    }
}
