<?php
namespace MetroPublisher\Api\Models;

use PHPUnit\Framework\TestCase;

/**
 * Class LocationReviewTest
 * @package Api\Models
 */
class LocationReviewTest extends TestCase
{
    public function testMetaFields() {
        $expected = [
            'location_uuid',
            'rating',
            'content',
            'meta_title',
            'meta_description',
            'print_description',
            'evergreen',
            'teaser_image_uuid',
            'feature_image_uuid'
        ];

        $this->assertEquals($expected, LocationReview::getMetaFields());
    }
}