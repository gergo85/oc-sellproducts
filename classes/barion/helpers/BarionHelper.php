<?php namespace Indikator\SellProducts\Classes\Barion\Helpers;

/**
 *  Helper functions
 */

class BarionHelper
{
    /**
     * Gets the value of the specified property from the json
     *
     * @param string $json The json
     * @param string $propertyName
     * @return null The value of the property
     */
    public static function jget($json, $propertyName)
    {
        return isset($json[$propertyName]) ? $json[$propertyName] : null;
    }

    public static function endsWith($haystack, $needle)
    {
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
    }
}
