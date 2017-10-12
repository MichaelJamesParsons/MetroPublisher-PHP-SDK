<?php
namespace MetroPublisher\Tests\Api\Models;

use MetroPublisher\Api\Models\EventOccurrence;
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
            'start_time',
            'end_time'
        ];

        $this->assertEquals($expected, EventOccurrence::getDefaultFields());
    }
}