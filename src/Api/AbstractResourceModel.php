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

    /** @var  DateTime */
    protected $created;

    /** @var  DateTime */
    protected $modified;

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
        if(empty($this->uuid)) {
            throw new ModelValidationException('Cannot save model of type ' . gettype($this) . '. No UUID is set.');
        }

        if(empty($this->created)) {
            return $this->context->put($endpoint, $this->serialize());
        }

        return $this->context->post($endpoint, $this->serialize());
    }

    /**
     * @param $endpoint
     *
     * @return array
     * @throws ModelValidationException
     */
    protected function doDelete($endpoint) {
        if (empty($this->uuid)) {
            throw new ModelValidationException('Cannot delete model of type ' . gettype($this) . '. No UUID is set.');
        }

        return $this->context->delete($endpoint, $this->serialize());
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
     * Unset fields that are marked as changed.
     *
     * Fields that have been flagged as changed should be excluded from the sync
     * to prevent old data from replacing pre-existing changes made by the application.
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
        if(!empty($this->uuid) && in_array($property, static::getMetaFields()) && !$this->isMetaDataLoaded) {
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
     * @return string
     */
    public function getUrlname()
    {
        return $this->urlname;
    }

    /**
     * @param string $urlname
     *
     * @return $this
     */
    public function setUrlname($urlname)
    {
        $this->urlname = $urlname;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->created;
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

    protected abstract function save();
    protected abstract function delete();
}