<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\MetroPublisher;

/**
 * Class LocationReview
 * @package MetroPublisher\Api\Models
 *
 * @property string $location_uuid
 */
class LocationReview extends AbstractReview
{
    /**
     * LocationReview constructor.
     *
     * @param MetroPublisher $metroPublisher
     */
    public function __construct(MetroPublisher $metroPublisher)
    {
        parent::__construct($metroPublisher);
        $this->content_type = Content::CONTENT_TYPE_REVIEW_LOCATION;
    }

    /**
     * @inheritdoc
     */
    public static function getMetaFields()
    {
        return array_merge(['location_uuid'], parent::getMetaFields());
    }
}