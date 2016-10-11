<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\AbstractApiResource;
use MetroPublisher\MetroPublisher;

/**
 * Class AbstractModel
 * @package MetroPublisher\Api\Models
 */
abstract class AbstractModel extends AbstractApiResource
{
    /**
     * Lists all of the fields that are allowed to be
     * sent to the API. Fields that are brought back
     * from a findBy() search should be defined in
     * the getFieldNames() method.
     *
     * @var array
     */
    protected static $allowedProperties = [];

    /** @var  array */
    protected $properties;

    public function __construct(MetroPublisher $metroPublisher)
    {
        parent::__construct($metroPublisher);

        $this->properties = [];
    }

    /**
     * @param $property
     *
     * @return bool
     */
    public function __isset($property)
    {
        return (isset($this->properties, $property));
    }

    /**
     * @param $property
     */
    public function __unset($property)
    {
        unset($this->properties[$property]);
    }

    /**
     * @param $property
     *
     * @return mixed|null
     */
    public function __get($property)
    {
        if($this->__isset($property)) {
            return $this->properties[$property];
        }

        return null;
    }

    /**
     * @param $property
     * @param $value
     *
     * @throws \Exception
     */
    public function __set($property, $value)
    {
        if(!in_array($property, $this->getFieldNames())) {
            throw new \Exception(sprintf("%s has no property %s.", get_class($this), $property));
        }

        if(is_null($value)) {
            $this->__unset($property);
        } else {
            $this->properties[$property] = $value;
        }
    }

    public function toJson() {
        return json_encode($this->properties);
    }

    /**
     * @return array
     */
    protected abstract function getFieldNames();
}