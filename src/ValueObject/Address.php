<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 09.12.18
 * Time: 13:28
 */

namespace Boruta\BitcoinVanity\ValueObject;


use BitWasp\Bitcoin\Address\AddressCreator;
use Boruta\BitcoinVanity\Exception\ValueObjectException;
use Exception;

/**
 * Class Address
 * @package Boruta\BitcoinVanity\ValueObject
 */
class Address implements ValueObjectInterface
{
    /**
     * @var string
     */
    protected $value;

    /**
     * Address constructor.
     * @param $value
     * @throws ValueObjectException
     */
    public function __construct($value)
    {
        if (!$this->validate($value)) {
            throw new ValueObjectException('Address is incorrect!');
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
        try {
            $addressCreator = new AddressCreator();
            $addressCreator->fromString((string)$value);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
