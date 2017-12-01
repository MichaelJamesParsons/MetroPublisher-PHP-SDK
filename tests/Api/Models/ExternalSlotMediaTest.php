<?php

namespace MetroPublisher\Api\Models;

use MetroPublisher\MetroPublisher;
use PHPUnit\Framework\TestCase;

/**
 * Class ExternalSlotMediaTest
 * @package Api\Models
 */
class ExternalSlotMediaTest extends TestCase
{
    public function testSlotMediaType()
    {
        /** @var MetroPublisher $mockMetroPublisher */
        $mockMetroPublisher = $this->createMock(MetroPublisher::class);
        /** @var Slot $mockSlot */
        $mockSlot = $this->createMock(Slot::class);

        $externalMedia = new ExternalSlotMedia($mockMetroPublisher, $mockSlot);
        $this->assertEquals(SlotMedia::TYPE_EXTERNAL_URL, $externalMedia->getType());
    }

    public function testMediaFields()
    {
        $expected = [
            'url_type',
            'url',
            'urls',
            'content'
        ];

        $this->assertEquals($expected, ExternalSlotMedia::getMetaFields());
    }
}