<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\AbstractResourceModel;
use MetroPublisher\Api\Models\Exception\ModelValidationException;
use MetroPublisher\Api\Models\Resolvers\SlotMediaResolver;
use MetroPublisher\Common\Serializers\ModelDeserializer;

/**
 * Class Slot
 * @package MetroPublisher\Api\Models
 */
class Slot extends AbstractResourceModel
{
    /** @var  string */
    protected $content_uuid;

    /** @var  string */
    protected $relevance;

    /** @var  string */
    protected $display;

    /** @var  string */
    protected $url;

    /** @var  string */
    protected $content_url;

    /**
     * Relevance of the slot, i.e. how prominently it should be displayed within the content.
     *
     * @link https://api.metropublisher.com/resources/content.html#resource-put-content-slot-put-parameters
     */
    const RELEVANCE_INLINE = 'inline';

    /**
     * Relevance of the slot, i.e. how prominently it should be displayed within the content.
     *
     * @link https://api.metropublisher.com/resources/content.html#resource-put-content-slot-put-parameters
     */
    const RELEVANCE_ASIDE = 'aside';

    /**
     * Display the slot as a gallery.
     *
     * @link https://api.metropublisher.com/resources/content.html#resource-put-content-slot-put-parameters
     */
    const DISPLAY_GALLERY = 'gallery';

    /**
     * Display the gallery as a carousel.
     *
     * @link https://api.metropublisher.com/resources/content.html#resource-put-content-slot-put-parameters
     */
    const DISPLAY_CAROUSEL = 'carousel';

    /**
     * @inheritdoc
     */
    public function save($endpoint)
    {
        if(empty($this->content_uuid)) {
            throw new ModelValidationException("Cannot save slot with no content UUID set.");
        }

        return parent::save("/content/{$this->content_uuid}/slots/{$this->uuid}");
    }

    /**
     * @inheritdoc
     */
    public function delete($endpoint)
    {
        if(empty($this->content_uuid)) {
            throw new ModelValidationException("Cannot save slot with no content UUID set.");
        }

        return parent::delete("/content/{$this->content_uuid}/slots/{$this->uuid}");
    }

    /**
     * Fetch the the slot's media objects.
     *
     * @link https://api.metropublisher.com/resources/content.html#content_slot_media_get
     *
     * @return SlotMedia[]
     */
    public function getMedia() {
        $response = $this->client->get("/content/{$this->content_uuid}/slots/{$this->uuid}/media");

        /** @var SlotMedia[] $media */
        $media = ModelDeserializer::convertCollection(new SlotMediaResolver(), $response);
        return $media;
    }

    /**
     * @return string
     */
    public function getContentUuid()
    {
        return $this->content_uuid;
    }

    /**
     * @param string $content_uuid
     *
     * @return $this
     */
    public function setContentUuid($content_uuid)
    {
        $this->content_uuid = $content_uuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getRelevance()
    {
        return $this->relevance;
    }

    /**
     * @param string $relevance
     *
     * @return $this
     */
    public function setRelevance($relevance)
    {
        $this->relevance = $relevance;

        return $this;
    }

    /**
     * @return string
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * @param string $display
     *
     * @return $this
     */
    public function setDisplay($display)
    {
        $this->display = $display;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public static function getFieldNames()
    {
        return array_merge([
            'url',
            'content_uuid',
            'relevance',
            'display',
            'content_url'
        ], parent::getFieldNames());
    }

    /**
     * @inheritdoc
     */
    protected function loadMetaData()
    {
        if(empty($this->content_uuid)) {
            throw new ModelValidationException("Cannot load slot meta fields with no content UUID set.");
        }

        return $this->client->get("/content/{$this->content_uuid}/slots/{$this->uuid}");
    }
}