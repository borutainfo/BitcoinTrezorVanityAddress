<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 10.01.19
 * Time: 18:10
 */

namespace Boruta\BitcoinVanity\Mapper;


/**
 * Class SemaphoreEntityMapper
 * @package Boruta\BitcoinVanity\Mapper
 */
class SemaphoreEntityMapper
{
    public const TABLE = 'semaphore';

    public const FIELD_LOCKED_ID = 'locked_id';
    public const FIELD_TYPE = 'type';
    public const FIELD_INSTANCE = 'instance';
}
