<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Collection;


use Boruta\BitcoinVanity\Entity\AddressEntity;
use Boruta\CommonAbstraction\Collection\CollectionAbstract;

/**
 * Class AddressEntityCollection
 * @package Boruta\BitcoinVanity\Collection
 */
class AddressEntityCollection extends CollectionAbstract
{
    protected const ELEMENT_CLASS = AddressEntity::class;
}
