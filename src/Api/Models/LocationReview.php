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
        $this->properties['contentType'] = Content::CONTENT_TYPE_REVIEW_LOCATION;
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
     * @return $this
     */
    public function setLocationUuid($location_uuid)
    {
        $this->location_uuid = $location_uuid;

        return $this;
    }
}