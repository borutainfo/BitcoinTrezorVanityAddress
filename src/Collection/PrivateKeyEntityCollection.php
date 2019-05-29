<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Collection;


use Boruta\BitcoinVanity\Entity\PrivateKeyEntity;
use Boruta\CommonAbstraction\Collection\CollectionAbstract;

/**
 * Class PrivateKeyEntityCollection
 * @package Boruta\BitcoinVanity\Collection
 */
class PrivateKeyEntityCollection extends CollectionAbstract
{
    protected const ELEMENT_CLASS = PrivateKeyEntity::class;
}
