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