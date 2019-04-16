<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Mapper;


/**
 * Class WordEntityMapper
 * @package Boruta\BitcoinVanity\Mapper
 */
abstract class WordEntityMapper
{
    public const TABLE = 'words';

    public const FIELD_ID = 'id';
    public const FIELD_WORD = 'word';
    public const FIELD_VALUE = 'value';
}
