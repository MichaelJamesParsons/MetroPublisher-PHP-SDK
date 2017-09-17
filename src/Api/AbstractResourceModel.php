<?php
namespace MetroPublisher\Api;

use DateTime;
use MetroPublisher\Api\Models\AbstractModel;
use MetroPublisher\Api\Models\Exception\ModelValidationException;
use MetroPublisher\Common\Serializers\ModelDeserializer;
use MetroPublisher\MetroPublisher;

/**
 * Class AbstractResourceModel
 * @package MetroPublisher\Api\Models
 */
abstract class AbstractResourceModel extends AbstractModel
{
    /** @var  boolean */
    protected $isMetaDataLoaded;

    /** @var  array */
    protected $changedFields;

    /**
     * AbstractResourceModel constructor.
     *
     * @param MetroPublisher $metroPublisher
     */
    public function __construct(MetroPublisher $metroPublisher)
    {
        parent::__construct($metroPublisher);

        $this->isMetaDataLoaded = false;
        $this->changedFields = [];
    }

    /**
     * @return boolean
     */
    public function isMetaDataLoaded()
    {
        return $this->isMetaDataLoaded;
    }

    /**
     * @param boolean $isMetaDataLoaded
     */
    public function setMetaDataLoaded($isMetaDataLoaded)
    {
        $this->isMetaDataLoaded = $isMetaDataLoaded;
    }

    /**
     * @param $endpoint
     *
     * @return array
     * @throws ModelValidationException
     */
    protected function doSave($endpoint) {
        if(empty($this->fields['uuid'])) {
            throw new ModelValidationException("Cannot save " . gettype($this) . ". UUID not set.");
        }

        if(empty($this->created)) {
            return $this->client->put($this->getBaseUri() . $endpoint, $this->serialize());
        }

        return $this->client->post($this->getBaseUri() . $endpoint, $this->serialize());
    }

    /**
     * @param $endpoint
     *
     * @return array
     */
    protected function doDelete($endpoint) {
        return $this->client->delete($this->getBaseUri() . $endpoint, $this->serialize());
    }

    /**
     * Get additional information about an object.
     *
     * This information will include meta fields, such as the
     * public URL of this content.
     */
    public function syncFields() {
        /** @var array $values */
        $values = $this->loadMetaData();
        ModelDeserializer::mergeValuesWithInstance($this, $this->unsetChangedFields($values));
        $this->setMetaDataLoaded(true);
    }

    /**
     * Unset the array key if it has been changed.
     *
     * @param array $values - The results to alter.
     *
     * @return array        - The results with specific keys unset.
     */
    protected function unsetChangedFields(array $values) {
        foreach($this->changedFields as $changedField => $value) {
            unset($values[$changedField]);
        }

        return $values;
    }

    /**
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        if(in_array($property, static::getMetaFields()) && !$this->isMetaDataLoaded) {
            $this->syncFields();
        }

        return parent::__get($property);
    }

    public function __set($property, $value) {
        if(!$this->isMetaDataLoaded() && in_array($property, static::getMetaFields())) {
            $this->changedFields[] = $property;
        }

        parent::__set($property, $value);
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->fields['uuid'];
    }

    /**
     * @param string $uuid
     */
    public function setUuid($uuid)
    {
        $this->fields['uuid'] = $uuid;
    }

    /**
     * @return string
     */
    public function getUrlname()
    {
        return $this->fields['urlname'];
    }

    /**
     * @param string $urlname
     */
    public function setUrlname($urlname)
    {
        $this->fields['urlname'] = $urlname;
    }

    /**
     * @return DateTime
     */
    public function getModified()
    {
        return $this->fields['modified'];
    }

    /**
     * @param DateTime $modified
     */
    public function setModified($modified)
    {
        $this->fields['modified'] = $modified;
    }

    /**
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->fields['created'];
    }

    /**
     * @param DateTime $created
     */
    public function setCreated($created)
    {
        $this->fields['created'] = $created;
    }


    /**
     * @inheritdoc
     */
    public static function getDefaultFields() {
        return [
            'uuid',
            'urlname',
            'created',
            'modified'
        ];
    }

    protected function serialize() {
        return $this->serializer->serialize($this);
    }

    /**
     * @return array
     */
    protected abstract function loadMetaData();
}