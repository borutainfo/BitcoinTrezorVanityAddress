<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Mapper;


/**
 * Class MnemonicSeedEntityMapper
 * @package Boruta\BitcoinVanity\Mapper
 */
abstract class MnemonicSeedEntityMapper
{
    public const TABLE = 'mnemonic_seeds';

    public const FIELD_ID = 'id';
    public const FIELD_ENCRYPTED_PHRASE = 'encrypted_phrase';
    public const FIELD_ENTROPY_SIZE = 'entropy_size';
}
