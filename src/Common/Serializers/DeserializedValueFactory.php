<?php

namespace MetroPublisher\Common\Serializers;

/**
 * Class DeserializedValueFactory
 * @package MetroPublisher\Common\Serializers
 */
class DeserializedValueFactory
{
    public static function getValue($value, $type)
    {
        switch ($type) {
            case "int":
                return intval($value);
            case "float":
                return floatval($value);
            case "\\DateTime":
                return new \DateTime($value);
            case "string":
            default:
                return $value . "";
        }
    }
}