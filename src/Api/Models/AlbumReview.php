<?php
namespace MetroPublisher\Api\Models;

use DateTime;
use MetroPublisher\MetroPublisher;

/**
 * Class AlbumReview
 * @package MetroPublisher\Api\Models
 *
 * @property double     $rating
 * @property string     $album_title
 * @property string     $album_image_uuid
 * @property DateTime   $album_issued
 * @property array      $album_provider_urls
 * @property array      $album_buy_urls
 * @property
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
        $this->properties['contentType'] = Content::CONTENT_TYPE_REVIEW_ALBUM;
    }
}