<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 09.12.18
 * Time: 14:59
 */

namespace Boruta\BitcoinVanity\Mapper;


/**
 * Class AddressEntityMapper
 * @package Boruta\BitcoinVanity\Mapper
 */
class AddressEntityMapper
{
    public const TABLE = 'addresses';

    public const FIELD_ID = 'id';
    public const FIELD_ADDRESS = 'address';
    public const FIELD_DERIVED_PATH = 'derived_path';
    public const FIELD_MNEMONIC_ID = 'mnemonic_id';
    public const FIELD_PRIVATE_KEY_ID = 'private_key_id';
}
