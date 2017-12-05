<?php

namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\AbstractResourceModel;
use MetroPublisher\Api\DeletableResourceModelTrait;
use MetroPublisher\Api\Models\Exception\ModelValidationException;
use MetroPublisher\Api\Models\Resolvers\SlotMediaResolver;
use MetroPublisher\Common\Serializers\ModelDeserializer;
use MetroPublisher\MetroPublisher;

/**
 * Class Slot
 * @package MetroPublisher\Api\Models
 */
class Slot extends AbstractResourceModel
{
    use DeletableResourceModelTrait;

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

    /** @var string */
    protected $content_uuid;

    /** @var string */
    protected $relevance;

    /** @var string */
    protected $display;

    /** @var string */
    protected $url;

    /** @var string */
    protected $content_url;

    /** @var  SlotMedia[] */
    protected $items;

    /**
     * Slot constructor.
     *
     * @param MetroPublisher $metroPublisher
     * @param string         $uuid
     */
    public function __construct(MetroPublisher $metroPublisher, $uuid)
    {
        parent::__construct($metroPublisher, $uuid);
        $this->display   = self::DISPLAY_GALLERY;
        $this->relevance = self::RELEVANCE_INLINE;
        $this->items     = [];
    }

    /**
     * @inheritdoc
     */
    public static function getDefaultFields()
    {
        return array_merge([
            'url',
            'content_uuid',
            'relevance',
            'display',
            'content_url',
            'content_uuid'
        ], parent::getDefaultFields());
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        if (empty($this->content_uuid)) {
            throw new ModelValidationException("Cannot save slot with no content UUID set.");
        }

        $endpoint = "/content/{$this->content_uuid}/slots/{$this->uuid}";
        $this->doSave("/content/{$this->content_uuid}/slots/{$this->uuid}");

        $serializedMedia = [];
        foreach ($this->items as $media) {
            $tmp = $this->serializer->serialize($media);
            unset($tmp['file_uuid']);
            $serializedMedia[] = $tmp;
        }

        return $this->context->put($endpoint . '/media', ['items' => $serializedMedia]);
    }

    /**
     * @inheritdoc
     */
    public function delete()
    {
        if (empty($this->content_uuid)) {
            throw new ModelValidationException("Cannot save slot with no content UUID set.");
        }

        return $this->doDelete("/content/{$this->content_uuid}/slots/{$this->uuid}");
    }

    /**
     * Fetch the the slot's media objects.
     *
     * @link https://api.metropublisher.com/resources/content.html#content_slot_media_get
     *
     * @return SlotMedia[]
     */
    public function getMedia()
    {
        $response = $this->context->get("/content/{$this->content_uuid}/slots/{$this->uuid}/media");

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
     * @return string
     */
    public function getContentUrl()
    {
        return $this->content_url;
    }

    /**
     * @param string $content_url
     *
     * @return $this
     */
    public function setContentUrl($content_url)
    {
        $this->content_url = $content_url;

        return $this;
    }

    /**
     * @param SlotMedia $mediaSlot
     *
     * @return $this
     */
    public function addMedia(SlotMedia $mediaSlot)
    {
        $this->items[] = $mediaSlot;

        return $this;
    }

    /**
     * @inheritdoc
     */
    protected function loadMetaData()
    {
        if (empty($this->content_uuid)) {
            throw new ModelValidationException("Cannot load slot meta fields with no content UUID set.");
        }

        return $this->context->get("/content/{$this->content_uuid}/slots/{$this->uuid}");
    }
}