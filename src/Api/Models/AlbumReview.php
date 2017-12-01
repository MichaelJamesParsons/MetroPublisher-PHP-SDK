<?php

namespace MetroPublisher\Api\Models;

use DateTime;
use MetroPublisher\MetroPublisher;

/**
 * Class AlbumReview
 * @package MetroPublisher\Api\Models
 */
class AlbumReview extends AbstractReview
{
    /** @var  string */
    protected $album_title;

    /** @var  string */
    protected $album_image_uuid;

    /** @var  DateTime */
    protected $album_issued;

    /** @var array */
    protected $album_provider_urls;

    /** @var array */
    protected $album_buy_urls;

    /**
     * AlbumReview constructor.
     *
     * @param MetroPublisher $metroPublisher
     */
    public function __construct(MetroPublisher $metroPublisher)
    {
        parent::__construct($metroPublisher);
        $this->content_type        = Content::CONTENT_TYPE_REVIEW_ALBUM;
        $this->album_provider_urls = [];
        $this->album_buy_urls      = [];
    }

    /**
     * @inheritdoc
     */
    public static function getMetaFields()
    {
        return array_merge([
            'album_title',
            'album_image_uuid',
            'album_issued',
            'album_provider_urls',
            'album_buy_urls'
        ], parent::getMetaFields());
    }

    /**
     * @return string
     */
    public function getAlbumTitle()
    {
        return $this->album_title;
    }

    /**
     * @param string $album_title
     *
     * @return $this
     */
    public function setAlbumTitle($album_title)
    {
        $this->album_title = $album_title;

        return $this;
    }

    /**
     * @return string
     */
    public function getAlbumImageUuid()
    {
        return $this->album_image_uuid;
    }

    /**
     * @param string $album_image_uuid
     *
     * @return $this
     */
    public function setAlbumImageUuid($album_image_uuid)
    {
        $this->album_image_uuid = $album_image_uuid;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getAlbumIssued()
    {
        return $this->album_issued;
    }

    /**
     * @param DateTime $album_issued
     *
     * @return $this
     */
    public function setAlbumIssued($album_issued)
    {
        $this->album_issued = $album_issued;

        return $this;
    }

    /**
     * @return array
     */
    public function getAlbumProviderUrls()
    {
        return $this->album_provider_urls;
    }

    /**
     * @param array $album_provider_urls
     *
     * @return $this
     */
    public function setAlbumProviderUrls($album_provider_urls)
    {
        $this->album_provider_urls = $album_provider_urls;

        return $this;
    }

    /**
     * @param $url - A link to iTunes or Amazon.
     *
     * @return $this
     */
    public function addAlbumProviderUrl($url)
    {
        if (!in_array($url, $this->album_provider_urls)) {
            $this->album_provider_urls[] = $url;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getAlbumBuyUrls()
    {
        return $this->album_buy_urls;
    }

    /**
     * @param array $album_buy_urls
     *
     * @return $this
     */
    public function setAlbumBuyUrls($album_buy_urls)
    {
        $this->album_buy_urls = $album_buy_urls;

        return $this;
    }

    /**
     * @param $url
     * @param $linkText
     *
     * @return $this
     */
    public function addAlbumBuyUrl($url, $linkText)
    {
        foreach ($this->album_buy_urls as $dict) {
            if ($dict['url'] === $url && $dict['link_text'] === $linkText) {
                return $this;
            }
        }

        $this->album_buy_urls[] = [
            'url'       => $url,
            'link_text' => $linkText
        ];

        return $this;
    }
}