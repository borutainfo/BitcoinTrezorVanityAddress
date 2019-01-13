<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 09.12.18
 * Time: 14:58
 */

namespace Boruta\BitcoinVanity\Mapper;


/**
 * Class MnemonicSeedEntityMapper
 * @package Boruta\BitcoinVanity\Mapper
 */
class MnemonicSeedEntityMapper
{
    public const TABLE = 'mnemonic_seeds';

    public const FIELD_ID = 'id';
    public const FIELD_ENCRYPTED_PHRASE = 'encrypted_phrase';
    public const FIELD_ENTROPY_SIZE = 'entropy_size';
}
