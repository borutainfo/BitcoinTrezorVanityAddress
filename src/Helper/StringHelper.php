<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 07.01.19
 * Time: 21:03
 */

namespace Boruta\BitcoinVanity\Helper;


/**
 * Class StringHelper
 * @package Boruta\BitcoinVanity\Helper
 */
abstract class StringHelper
{
    /**
     * @param $value
     * @return string
     */
    public static function convertDiacriticAndStandarize(string $value): string
    {
        $value = iconv('UTF-8', 'ASCII//TRANSLIT', $value);
        $value = str_replace(['^', "'", '"', '`', '~'], '', $value);
        $value = preg_replace('/[^a-zA-Z0-9\s]/', '', strtolower($value));
        $value = trim(preg_replace('# +#', ' ', $value));
        return $value;
    }
}
