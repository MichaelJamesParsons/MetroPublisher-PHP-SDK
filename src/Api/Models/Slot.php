<?php
namespace MetroPublisher\Api\Models;

/**
 * Class Slot
 * @package MetroPublisher\Api\Models
 *
 * @property string $uuid
 * @property string $content_uuid
 * @property string $relevance
 * @property string $display
 * @property string $url
 * @property string $content_url
 *
 * @todo Consider converting this into an AbstractResourceModel
 */
class Slot extends AbstractModel
{
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
    public function getFieldNames()
    {
        return [
            'uuid',
            'url',
            'content_uuid',
            'relevance',
            'display',
            'content_url'
        ];
    }
}