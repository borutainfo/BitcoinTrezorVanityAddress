<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\ValueObject;


use Boruta\CommonAbstraction\Exception\ValueObjectException;
use Boruta\BitcoinVanity\Helper\StringHelper;
use Boruta\CommonAbstraction\ValueObject\ValueObjectInterface;

/**
 * Class Word
 * @package Boruta\BitcoinVanity\ValueObject
 */
class Word implements ValueObjectInterface
{
    protected const MIN_LENGTH = 5;
    protected const MAX_LENGTH = 32;

    /**
     * @var string
     */
    protected $value;

    /**
     * Word constructor.
     * @param $value
     */
    public function __construct($value)
    {
        if (!$this->validate($value)) {
            throw new ValueObjectException('Word is incorrect!');
        }
        $this->value = (string)$value;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function validate($value): bool
    {
        $length = \strlen($value);
        return $length >= self::MIN_LENGTH && $length <= self::MAX_LENGTH && ctype_alnum($value);
    }

    /**
     * @param $value
     * @return Word
     */
    public static function createFromString($value): Word
    {
        $value = StringHelper::convertDiacriticAndStandarize((string)$value);
        return new self($value);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
