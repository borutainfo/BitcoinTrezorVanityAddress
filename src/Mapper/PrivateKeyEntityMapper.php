<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 09.12.18
 * Time: 14:56
 */

namespace Boruta\BitcoinVanity\Mapper;


/**
 * Class PrivateKeyEntityMapper
 * @package Boruta\BitcoinVanity\Mapper
 */
class PrivateKeyEntityMapper
{
    public const TABLE = 'private_keys';

    public const FIELD_ID = 'id';
    public const FIELD_ENCRYPTED_PRIVATE_KEY = 'encrypted_private_key';
}
