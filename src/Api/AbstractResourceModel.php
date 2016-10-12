<?php
namespace MetroPublisher\Api;

use DateTime;
use Exception;
use MetroPublisher\Api\Models\AbstractModel;
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
abstract class AbstractResourceModel extends AbstractModel
{
    /** @var  boolean */
    protected $isMetaDataLoaded;

    /** @var  AbstractResourceCollection */
    protected $collection;

    public function __construct(MetroPublisher $metroPublisher, AbstractResourceCollection $collection)
    {
        parent::__construct($metroPublisher);

        $this->collection = $collection;
        $this->isMetaDataLoaded = false;
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
     */
    protected function save($endpoint) {
        if(!empty($this->created)) {
            return $this->client->put($this->getBaseUri() . $endpoint, $this->properties);
        }

        return $this->client->post($this->getBaseUri() . $endpoint, $this->properties);
    }

    /**
     * @param $endpoint
     *
     * @return array
     */
    protected function delete($endpoint) {
        return $this->client->delete($this->getBaseUri() . $endpoint, $this->properties);
    }

    public function __get($property)
    {
        if(in_array($property, static::getMetaFields()) && !$this->isMetaDataLoaded) {
            $this->syncMetaData();
        }

        return parent::__get($property);
    }

    /**
     * Get additional information about an object.
     *
     * This information will include meta fields, such as the
     * public URL of this content.
     */
    public function syncMetaData() {
        /** @var AbstractResourceModel $model */
        $model = $this->collection->find($this->uuid);
        $model->setMetaDataLoaded(true);

        $this->syncFields($model);
        $this->setMetaDataLoaded(true);
    }

    /**
     * @param AbstractModel $model
     *
     * @throws Exception
     */
    protected function syncFields(AbstractModel $model) {
        if(!($model instanceof $this)) {
            throw new Exception(sprintf(
                "Cannot sync fields of %s with %s object.",
                get_class($model),
                get_class($this)
            ));
        }

        foreach($model::getFieldNames() as $field) {
            $this->{$field} = $model->{$field};
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
}