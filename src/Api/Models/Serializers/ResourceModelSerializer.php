<?php
namespace MetroPublisher\Api\Models\Serializers;

use MetroPublisher\Api\Models\AbstractModel;
use MetroPublisher\MetroPublisher;

/**
 * Class ResourceModelSerializer
 * @package MetroPublisher\Api\Models\Serializers
 */
class ResourceModelSerializer
{
    /** @var MetroPublisher */
    private $context;

    /**
     * ResourceModelSerializer constructor.
     *
     * @param MetroPublisher $metroPublisher
     */
    public function __construct(MetroPublisher $metroPublisher)
    {
        $this->context = $metroPublisher;
    }

    /**
     * @param       $model
     * @param array $properties
     * @param array $records
     *
     * @return array
     */
    public function serializeArrayCollectionToObjects($model, array $properties, array $records) {
        $collection = [];
        foreach($records as $serializedObject) {
            $collection[] = $this->serializeArrayToObject($model, $properties, $serializedObject);
        }

        return $collection;
    }

    /**
     * @param       $model
     * @param array $properties
     * @param array $values
     *
     * @return AbstractModel
     */
    public function serializeArrayToObject($model, array $properties, array $values) {
        /** @var AbstractModel $instance */
        $instance = $this->getInstance($model);
        $keys = array_keys($values);

        if(is_numeric($keys[0])) {
            return $this->serializeByIndex($instance, $properties, $values);
        }

        return $this->serializeByAssoc($instance, $values);
    }

    /**
     * @param AbstractModel $instance
     * @param array         $properties
     * @param array         $values
     *
     * @return AbstractModel
     */
    private function serializeByIndex(AbstractModel $instance, array $properties, array $values) {
        foreach($properties as $key => $property) {
            $instance->{$property} = $values[$key];
        }

        return $instance;
    }

    /**
     * @param AbstractModel $instance
     * @param array         $values
     *
     * @return AbstractModel
     */
    private function serializeByAssoc(AbstractModel $instance, array $values) {
        foreach($values as $property => $value) {
            $instance->{$property} = $value;
        }

        return $instance;
    }

    /**
     * @param $model
     *
     * @return object
     */
    public function getInstance($model) {
        $reflection = new \ReflectionClass($model);
        return $reflection->newInstanceArgs([$this->context]);
    }
}