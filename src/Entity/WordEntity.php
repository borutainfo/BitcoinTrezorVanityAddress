<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 07.01.19
 * Time: 21:09
 */

namespace Boruta\BitcoinVanity\Entity;

use Boruta\BitcoinVanity\ValueObject\UnsignedNumber;
use Boruta\BitcoinVanity\ValueObject\Word;


/**
 * Class WordEntity
 * @package Boruta\BitcoinVanity\Entity
 */
class WordEntity
{
    /**
     * @var UnsignedNumber
     */
    protected $id;
    /**
     * @var Word
     */
    protected $word;
    /**
     * @var UnsignedNumber
     */
    protected $value;

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
     * @return Word|null
     */
    public function getWord(): ?Word
    {
        return $this->word;
    }

    /**
     * @param Word $word
     */
    public function setWord(Word $word): void
    {
        $this->word = $word;
    }

    /**
     * @return UnsignedNumber|null
     */
    public function getValue(): ?UnsignedNumber
    {
        return $this->value;
    }

    /**
     * @param UnsignedNumber $value
     */
    public function setValue(UnsignedNumber $value): void
    {
        $this->value = $value;
    }
}
