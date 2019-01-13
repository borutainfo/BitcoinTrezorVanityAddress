<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 09.12.18
 * Time: 02:36
 */

namespace Boruta\BitcoinVanity\ValueObject;


use Boruta\BitcoinVanity\Exception\ValueObjectException;

/**
 * Class UnsignedNumber
 * @package Boruta\BitcoinVanity\ValueObject
 */
class UnsignedNumber implements ValueObjectInterface
{
    /**
     * @var int
     */
    protected $value;

    /**
     * UnsignedNumber constructor.
     * @param $value
     * @throws ValueObjectException
     */
    public function __construct($value)
    {
        if (!$this->validate($value)) {
            throw new ValueObjectException('Number is incorrect!');
        }
        $this->value = (int)$value;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function validate($value): bool
    {
        return is_numeric($value) && (int)$value >= 0 && (string)(int)$value === (string)$value;
    }
}
