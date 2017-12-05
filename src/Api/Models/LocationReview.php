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
    /** @var string */
    protected $location_uuid;

    /**
     * LocationReview constructor.
     *
     * @param MetroPublisher $metroPublisher
     * @param string         $uuid
     */
    public function __construct(MetroPublisher $metroPublisher, $uuid)
    {
        parent::__construct($metroPublisher, $uuid);
        $this->content_type = Content::CONTENT_TYPE_REVIEW_LOCATION;
    }

    /**
     * @inheritdoc
     */
    public static function getMetaFields()
    {
        return array_merge(['location_uuid'], parent::getMetaFields());
    }

    /**
     * @return string
     */
    public function getLocationUuid()
    {
        return $this->location_uuid;
    }

    /**
     * @param string $location_uuid
     *
     * @return LocationReview
     */
    public function setLocationUuid($location_uuid)
    {
        $this->location_uuid = $location_uuid;

        return $this;
    }
}