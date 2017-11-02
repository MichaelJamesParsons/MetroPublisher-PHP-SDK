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
    public function serialize(AbstractModel $model)
    {
        return $this->getObjectPropertyValuesAsArray($model, $model::getFieldNames());
    }

    protected function getObjectPropertyValuesAsArray($model, array $properties = array()) {
        $array = [];
        $reflection = ReflectionUtils::getReflectionObject($model);

        if(count($properties) === 0) {
            $properties = $reflection->getProperties();
        }

        foreach($properties as $field) {
            if (is_string($field)) {
                $propertyReflection = $reflection->getProperty($field);
            } else {
                $propertyReflection = $field;
            }

            $propertyReflection->setAccessible(true);
            $value = $propertyReflection->getValue($model);

            if(!is_null($value)) {
                $array[$propertyReflection->getName()] = $this->convertValueToSerializable($value);
            }
        }

        return $array;
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    protected function convertValueToSerializable($value) {
        if($value instanceof \DateTime) {
            return $value->format('Y-m-d');
        } else if(is_array($value) && count($value) > 0 && $value[0] instanceof \DateTime) {
            return $this->convertDateTimeArray($value);
        } else if($value instanceof AbstractResourceModel) {
            return $value->getUuid();
        } else if(is_array($value) && count($value) > 0 && $value[0] instanceof AbstractResourceModel) {
            return $this->convertResourceModelArray($value);
        } else if(is_object($value)) {
            return $this->getObjectPropertyValuesAsArray($value);
        } else {
            return $value;
        }
    }

    /**
     * @param AbstractResourceModel[] $models
     *
     * @return array
     */
    protected function convertResourceModelArray(array $models) {
        $uuids = [];
        foreach($models as $model) {
            $uuids[] = $model->getUuid();
        }

        return $uuids;
    }

    /**
     * @param \DateTime[] $dateTimeList
     *
     * @return array
     */
    protected function convertDateTimeArray(array $dateTimeList) {
        $convertedDates = [];
        foreach($dateTimeList as $dateTime) {
            $convertedDates[] = $dateTime->format('Y-m-d');
        }

        return $convertedDates;
    }
}
