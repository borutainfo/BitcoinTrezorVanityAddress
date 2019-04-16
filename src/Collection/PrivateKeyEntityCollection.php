<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Collection;


use Boruta\BitcoinVanity\Entity\PrivateKeyEntity;

/**
 * Class PrivateKeyEntityCollection
 * @package Boruta\BitcoinVanity\Collection
 */
class PrivateKeyEntityCollection extends AbstractCollection
{
    protected const ELEMENT_CLASS = PrivateKeyEntity::class;
}
