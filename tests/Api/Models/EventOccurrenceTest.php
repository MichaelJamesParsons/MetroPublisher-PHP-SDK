<?php
namespace MetroPublisher\Api\Models;

use PHPUnit\Framework\TestCase;

/**
 * Class EventOccurrenceTest
 * @package Api\Models
 */
class EventOccurrenceTest extends TestCase
{
    public function testDefaultFields() {
        $expected = [
            'event_uuid',
            'dtstart',
            'dtend'
        ];

        $this->assertEquals($expected, EventOccurrence::getDefaultFields());
    }
}