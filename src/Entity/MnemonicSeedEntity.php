<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */
namespace Boruta\BitcoinVanity\Entity;


use Boruta\BitcoinVanity\ValueObject\EntropySize;
use Boruta\BitcoinVanity\ValueObject\RawString;
use Boruta\BitcoinVanity\ValueObject\UnsignedNumber;

/**
 * Class MnemonicSeedEntity
 * @package Boruta\BitcoinVanity\Entity
 */
class MnemonicSeedEntity
{
    /**
     * @var UnsignedNumber
     */
    protected $id;
    /**
     * @var RawString
     */
    protected $encryptedPhrase;
    /**
     * @var EntropySize
     */
    protected $entropySize;

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
    public function getEncryptedPhrase(): ?RawString
    {
        return $this->encryptedPhrase;
    }

    /**
     * @param RawString $encryptedPhrase
     */
    public function setEncryptedPhrase(RawString $encryptedPhrase): void
    {
        $this->encryptedPhrase = $encryptedPhrase;
    }

    /**
     * @return EntropySize|null
     */
    public function getEntropySize(): ?EntropySize
    {
        return $this->entropySize;
    }

    /**
     * @param EntropySize $entropySize
     */
    public function setEntropySize(EntropySize $entropySize): void
    {
        $this->entropySize = $entropySize;
    }
}
