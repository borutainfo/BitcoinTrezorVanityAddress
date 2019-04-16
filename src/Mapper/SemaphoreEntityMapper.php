<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Mapper;


/**
 * Class SemaphoreEntityMapper
 * @package Boruta\BitcoinVanity\Mapper
 */
abstract class SemaphoreEntityMapper
{
    public const TABLE = 'semaphore';

    public const FIELD_LOCKED_ID = 'locked_id';
    public const FIELD_TYPE = 'type';
    public const FIELD_INSTANCE = 'instance';
}
