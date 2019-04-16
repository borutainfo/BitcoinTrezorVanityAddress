<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Mapper;


/**
 * Class PrivateKeyEntityMapper
 * @package Boruta\BitcoinVanity\Mapper
 */
abstract class PrivateKeyEntityMapper
{
    public const TABLE = 'private_keys';

    public const FIELD_ID = 'id';
    public const FIELD_ENCRYPTED_PRIVATE_KEY = 'encrypted_private_key';
}
