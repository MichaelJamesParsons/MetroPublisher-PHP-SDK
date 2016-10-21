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
    /** @var  string */
    protected $uuid;

    /** @var  string */
    protected $urlname;

    /** @var  DateTime */
    protected $modified;

    /** @var  DateTime */
    protected $created;

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
     * @return DateTime
     */
    public function getModified()
    {
        return new DateTime($this->modified);
    }

    /**
     * @param DateTime $modified
     *
     * @return $this
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreated()
    {
        return new DateTime($this->created);
    }

    /**
     * @param DateTime $created
     *
     * @return $this
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
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
    protected function save($endpoint) {
        if(empty($this->uuid)) {
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
    protected function delete($endpoint) {
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
     */
    public function __get($property)
    {
        if(in_array($property, static::getMetaFields()) && !$this->isMetaDataLoaded) {
            $this->syncFields();
        }
    }

    public function __set($property, $value) {
        if(!$this->isMetaDataLoaded() && in_array($property, static::getMetaFields())) {
            $this->changedFields[] = $property;
        }
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