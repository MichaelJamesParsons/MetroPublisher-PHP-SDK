<?php
namespace MetroPublisher\Tests\Api\Models;

use MetroPublisher\Api\Models\Event;
use PHPUnit\Framework\TestCase;

/**
 * Class EventTest
 * @package Api\Models
 */
class EventTest extends TestCase
{
    public function testMetaFields() {
        $expected = [
            'location_uuid',
            'location_alt',
            'dtstart',
            'dtend',
            'website',
            'prices',
            'user_email',
            'email',
            'phone',
            'rrule',
            'rdates',
            'exdates',
            'recurrence_id',
            'ical_uid',
            'sort_title',
            'content',
            'meta_title',
            'meta_description',
            'print_description',
            'evergreen',
            'teaser_image_uuid',
            'feature_image_uuid'
        ];

        $this->assertEquals($expected, Event::getMetaFields());
    }
}