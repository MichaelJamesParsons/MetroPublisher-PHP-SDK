<?php

namespace MetroPublisher\Common\Serializers;

use MetroPublisher\Common\AnnotationParser;
use MetroPublisher\Common\ReflectionUtils;
use ReflectionClass;
use ReflectionProperty;

/**
 * Class AbstractSerializer
 * @package MetroPublisher\Common\Serializers
 */
abstract class AbstractSerializer
{
    /**
     * @param ReflectionClass $class
     *
     * @return array
     */
    public static function getObjectPropertyMapping(ReflectionClass $class)
    {
        $parser               = AnnotationParser::getInstance();
        $reflectionProperties = ReflectionUtils::getClassProperties($class);
        $propertiesMapping    = [];

        /** @var ReflectionProperty $property */
        foreach ($reflectionProperties as $property) {
            $annotations = $parser->getPropertyAnnotation($property)->getTagsByName("var");

            if (count($annotations) == 1) {
                $propertiesMapping[$property->getName()] = (string)$annotations[0]->getType();
            }
        }

        return $propertiesMapping;
    }
}