<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Mapper;


/**
 * Class AddressWordEntityMapper
 * @package Boruta\BitcoinVanity\Mapper
 */
abstract class AddressWordEntityMapper
{
    public const TABLE = 'addresses_words';

    public const FIELD_ADDRESS_ID = 'address_id';
    public const FIELD_WORD_ID = 'word_id';
}
