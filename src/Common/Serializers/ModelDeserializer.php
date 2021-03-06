<?php

namespace MetroPublisher\Common\Serializers;

use MetroPublisher\Api\AbstractResourceModel;
use MetroPublisher\Api\Models\AbstractModel;
use MetroPublisher\Api\Models\Resolvers\ModelTypeResolverInterface;
use MetroPublisher\Common\ReflectionUtils;
use ReflectionObject;

/**
 * Class ModelDeserializer
 * @package MetroPublisher\Api\Models\Serializers
 */
class ModelDeserializer extends AbstractSerializer
{
    /**
     * @param ModelTypeResolverInterface $resolver
     * @param array                      $values
     * @param array                      $instanceArgs
     *
     * @return AbstractModel|AbstractResourceModel
     */
    public static function convert(ModelTypeResolverInterface $resolver, array $values, array $instanceArgs = [])
    {
        /** @var AbstractModel $modelType */
        $modelType = $resolver->resolve($values);
        $keys      = array_keys($values);

        if (is_numeric($keys[0])) {
            $fieldsMap = $modelType::getDefaultFields();
            $tmp       = $values;
            $values    = [];
            foreach ($tmp as $key => $value) {
                $values[$fieldsMap[$key]] = $value;
            }
        }

        $instance = ReflectionUtils::getInstance($modelType, $instanceArgs);

        return self::createInstance($instance, $values);
    }

    /**
     * @param AbstractModel $instance
     * @param array         $values
     *
     * @return AbstractModel
     */
    public static function mergeValuesWithInstance(AbstractModel $instance, array $values)
    {
        return self::createInstance($instance, $values);
    }

    /**
     * @param ModelTypeResolverInterface $resolver
     * @param array                      $values
     * @param array                      $instanceArgs
     *
     * @return \MetroPublisher\Api\Models\AbstractModel[]
     */
    public static function convertCollection(
        ModelTypeResolverInterface $resolver,
        array $values,
        array $instanceArgs = []
    ) {
        $collection = [];
        foreach ($values as $model) {
            $collection[] = self::convert($resolver, $model, $instanceArgs);
        }

        return $collection;
    }

    /**
     * @param       $instance
     * @param array $values
     *
     * @return AbstractModel
     */
    protected static function createInstance($instance, array $values)
    {
        $reflection = ReflectionUtils::getReflectionObject($instance);
        $mapping    = self::getObjectPropertyMapping($reflection);

        return self::fillObjectProperties($instance, $reflection, $mapping, $values);
    }

    /**
     * @param                  $instance
     * @param ReflectionObject $reflection
     * @param array            $mapping
     * @param array            $properties
     *
     * @return AbstractModel
     */
    protected static function fillObjectProperties($instance, $reflection, array $mapping, array $properties)
    {
        foreach ($properties as $propertyName => $value) {
            if (array_key_exists($propertyName, $mapping)) {
                $reflectedProperty = $reflection->getProperty($propertyName);
                $reflectedProperty->setAccessible(true);

                $reflectedProperty->setValue(
                    $instance,
                    DeserializedValueFactory::getValue($value, $mapping[$propertyName])
                );
            }
        }

        return $instance;
    }
}