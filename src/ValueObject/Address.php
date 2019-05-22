<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\ValueObject;


use BitWasp\Bitcoin\Address\AddressCreator;
use Boruta\CommonAbstraction\Exception\ValueObjectException;
use Boruta\CommonAbstraction\ValueObject\ValueObjectInterface;
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
