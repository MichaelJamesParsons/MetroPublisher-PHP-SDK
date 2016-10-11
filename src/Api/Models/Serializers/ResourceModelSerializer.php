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

        foreach($properties as $key => $property) {
            $instance->{$property} = $values[$key];
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