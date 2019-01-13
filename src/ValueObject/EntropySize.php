<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 09.12.18
 * Time: 13:45
 */

namespace Boruta\BitcoinVanity\ValueObject;


use Boruta\BitcoinVanity\Constant\EntropySizeConstant;
use Boruta\BitcoinVanity\Exception\ValueObjectException;
use ReflectionClass;
use ReflectionException;

/**
 * Class EntropySize
 * @package Boruta\BitcoinVanity\ValueObject
 */
class EntropySize implements ValueObjectInterface
{
    /**
     * @var int
     */
    protected $value;

    /**
     * EntropySize constructor.
     * @param $value
     * @throws ValueObjectException
     */
    public function __construct($value)
    {
        if (!$this->validate($value)) {
            throw new ValueObjectException('Entropy size is incorrect!');
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
        try {
            $allowedEntropySize = (new ReflectionClass(EntropySizeConstant::class))->getConstants();
        } catch (ReflectionException $exception) {
            return false;
        }

        return (string)(int)$value === (string)$value && \in_array((int)$value, $allowedEntropySize, true);
    }
}
