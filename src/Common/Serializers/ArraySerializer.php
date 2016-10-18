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
        $fields = $model::getFieldNames();
        $reflection = ReflectionUtils::getReflectionObject($model);
        $array = [];

        foreach($fields as $field) {
            $propertyReflection = $reflection->getProperty($field);
            $propertyReflection->setAccessible(true);
            $value = $propertyReflection->getValue($model);

            if(!is_null($value)) {
                $array[$field] = $this->convertValueToSerializable($value);
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

        } else if($value instanceof AbstractResourceModel) {
            return $value->getUuid();

        } else if(is_array($value) && count($value) > 0 && $value[0] instanceof AbstractResourceModel) {
            return $this->convertResourceModelArray($value);

        } else {
            return $value;
        }
    }

    /**
     * @param array $models
     *
     * @return array
     */
    protected function convertResourceModelArray(array $models) {
        $uuids = [];

        /** @var AbstractResourceModel $model */
        foreach($models as $model) {
            $uuids[] = $model->getUuid();
        }

        return $uuids;
    }
}