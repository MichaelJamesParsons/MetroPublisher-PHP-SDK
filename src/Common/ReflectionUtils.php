<?php
namespace MetroPublisher\Common;

use ReflectionClass;

/**
 * Class ReflectionUtils
 * @package MetroPublisher\Common
 */
class ReflectionUtils
{
    public static function getReflectionObject($object) {
        return new \ReflectionObject($object);
    }

    public static function getReflectionClass($class) {
        return new ReflectionClass($class);
    }

    /**
     * @param       $class
     * @param array $args
     *
     * @return object
     */
    public static function getInstance($class, array $args = []) {
        $reflection = new ReflectionClass($class);
        return $reflection->newInstanceArgs($args);
    }

    /**
     * @param ReflectionClass $class
     *
     * @return \ReflectionProperty[]
     */
    public static function getClassProperties(ReflectionClass $class) {
        return $class->getProperties();
    }
}