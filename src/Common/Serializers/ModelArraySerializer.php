<?php

namespace MetroPublisher\Common\Serializers;

use MetroPublisher\Api\AbstractResourceModel;
use MetroPublisher\Api\Models\AbstractModel;
use MetroPublisher\Common\ReflectionUtils;

/**
 * Class ModelArraySerializer
 * @package MetroPublisher\Common\Serializers
 */
class ModelArraySerializer implements ModelSerializerInterface
{
    /**
     * @inheritdoc
     */
    public function serialize(AbstractModel $model, $includeEmptyValues = true)
    {
        return $this->getObjectPropertyValuesAsArray($model, $model::getFieldNames(), $includeEmptyValues);
    }

    protected function getObjectPropertyValuesAsArray($model, array $properties = array(), $includeEmptyValues)
    {
        $array      = [];
        $reflection = ReflectionUtils::getReflectionObject($model);

        if (count($properties) === 0) {
            $properties = $reflection->getProperties();
        }

        foreach ($properties as $field) {
            if (is_string($field)) {
                $propertyReflection = $reflection->getProperty($field);
            } else {
                $propertyReflection = $field;
            }

            $propertyReflection->setAccessible(true);
            $value = $propertyReflection->getValue($model);
            $serializedValue = $this->convertValueToSerializable($value);

            if ($includeEmptyValues || !empty($serializedValue)) {
                $array[$propertyReflection->getName()] = $this->convertValueToSerializable($value, $includeEmptyValues);
            }
        }

        return $array;
    }

    /**
     * @param $value
     *
     * @param bool $includeEmptyValues
     * @return mixed
     */
    protected function convertValueToSerializable($value, $includeEmptyValues = true)
    {
        if ($value instanceof \DateTime) {
            return $value->format('Y-m-d');
        } elseif (is_array($value) && count($value) > 0 && $value[0] instanceof \DateTime) {
            return $this->convertDateTimeArray($value);
        } elseif ($value instanceof AbstractResourceModel) {
            return $value->getUuid();
        } elseif (is_array($value) && count($value) > 0 && $value[0] instanceof AbstractResourceModel) {
            return $this->convertResourceModelArray($value);
        } elseif (is_object($value)) {
            return $this->getObjectPropertyValuesAsArray($value, $includeEmptyValues);
        }else if ($value === "1" || $value === "0") {
            return boolval($value);
        } elseif (!is_bool($value) && empty($value)) {
            return null;
        } else {
            return $value;
        }
    }

    /**
     * @param AbstractResourceModel[] $models
     *
     * @return array
     */
    protected function convertResourceModelArray(array $models)
    {
        $uuids = [];
        foreach ($models as $model) {
            $uuids[] = $model->getUuid();
        }

        return $uuids;
    }

    /**
     * @param \DateTime[] $dateTimeList
     *
     * @return array
     */
    protected function convertDateTimeArray(array $dateTimeList)
    {
        $convertedDates = [];
        foreach ($dateTimeList as $dateTime) {
            $convertedDates[] = $dateTime->format('Y-m-d');
        }

        return $convertedDates;
    }
}
