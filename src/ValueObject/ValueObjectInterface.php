<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\ValueObject;


/**
 * Interface ValueObjectInterface
 * @package Boruta\BitcoinVanity\ValueObject
 */
interface ValueObjectInterface
{
    /**
     * @return mixed
     */
    public function value();
}
