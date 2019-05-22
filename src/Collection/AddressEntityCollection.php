<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Collection;


use Boruta\BitcoinVanity\Entity\AddressEntity;
use Boruta\CommonAbstraction\Collection\AbstractCollection;

/**
 * Class AddressEntityCollection
 * @package Boruta\BitcoinVanity\Collection
 */
class AddressEntityCollection extends AbstractCollection
{
    protected const ELEMENT_CLASS = AddressEntity::class;
}
