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

    /**
     * @inheritdoc
     */
    protected function getFieldNames() {
        return [
            'uuid',
            'urlname',
            'created',
            'modified'
        ];
    }
}