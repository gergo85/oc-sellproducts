<?php namespace Indikator\SellProducts\Payments\Barion\Helpers;

/*
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
}