<?php
namespace MetroPublisher\Api;

use DateTime;
use MetroPublisher\MetroPublisher;

/**
 * Class AbstractResourceModel
 * @package MetroPublisher\Api\Models
 *
 * @property string   $uuid
 * @property string   $urlname
 * @property DateTime $modified
 * @property DateTime $created
 */
abstract class AbstractResourceModel extends AbstractApiResource
{
    /** @var  boolean */
    protected $isSaved;

    /** @var  boolean */
    protected $isMetaDataLoaded;

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
        $this->isSaved = false;
        $this->isMetaDataLoaded = true;
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     *
     * @return $this
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @return $this
     */
    public function getUrlname() {
        return $this;
    }

    /**
     * @param $urlname
     *
     * @return $this
     */
    public function setUrlname($urlname) {
        $this->urlname = $urlname;

        return $this;
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
            throw new \Exception(sprintf("%s has no property %s.", get_class($this), $value));
        }

        if(is_null($value)) {
            $this->__unset($property);
        } else {
            $this->properties[$property] = $value;
        }
    }

    /**
     * @param $endpoint
     *
     * @return array
     */
    protected function save($endpoint) {
        if($this->isSaved) {
            return $this->client->put($this->getBaseUri() . $endpoint, $this->toJson());
        }

        return $this->client->post($this->getBaseUri() . $endpoint, $this->toJson());
    }

    /**
     * @param $endpoint
     *
     * @return array
     */
    protected function delete($endpoint) {
        return $this->client->delete($this->getBaseUri() . $endpoint, $this->toJson());
    }

    public function toJson() {
        return json_encode($this->properties);
    }

    protected function getFieldNames() {
        return [
            'uuid',
            'urlname',
            'created',
            'modified'
        ];
    }
}