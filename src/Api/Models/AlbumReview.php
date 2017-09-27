<?php
namespace MetroPublisher\Api\Models;

use DateTime;
use MetroPublisher\MetroPublisher;

/**
 * Class AlbumReview
 * @package MetroPublisher\Api\Models
 *
 * @property string     $album_title
 * @property string     $album_image_uuid
 * @property DateTime   $album_issued
 * @property array      $album_provider_urls
 * @property array      $album_buy_urls
 */
class AlbumReview extends AbstractReview
{
    /**
     * AlbumReview constructor.
     *
     * @param MetroPublisher $metroPublisher
     */
    public function __construct(MetroPublisher $metroPublisher)
    {
        parent::__construct($metroPublisher);
        $this->content_type = Content::CONTENT_TYPE_REVIEW_ALBUM;
        $this->album_provider_urls = [];
        $this->album_buy_urls = [];
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
     */
    public function setAlbumProviderUrls($album_provider_urls)
    {
        $this->album_provider_urls = $album_provider_urls;
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
     * @return $this
     */
    public function setAlbumBuyUrls($album_buy_urls)
    {
        $this->album_buy_urls = $album_buy_urls;
        return $this;
    }

    /**
     * @param $url
     * @return $this
     */
    public function addAlbumBuyUrl($url) {
        if(!in_array($url, $this->album_buy_urls)) {
            $this->album_buy_urls[] = $url;
        }

        return $this;
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
}