<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\ValueObject;


use Boruta\BitcoinVanity\Constant\EntropySizeConstant;
use Boruta\CommonAbstraction\Exception\ValueObjectException;
use Boruta\CommonAbstraction\ValueObject\ValueObjectInterface;
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
