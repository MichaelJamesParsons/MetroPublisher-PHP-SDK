<?php
namespace Api\Models;

use MetroPublisher\Api\Models\EmbedSlotMedia;
use MetroPublisher\Api\Models\Slot;
use MetroPublisher\Api\Models\SlotMedia;
use MetroPublisher\MetroPublisher;
use PHPUnit\Framework\TestCase;

/**
 * Class EmbedSlotMediaTest
 * @package Api\Models
 */
class EmbedSlotMediaTest extends TestCase
{
    public function testSlotType() {
        /** @var MetroPublisher $mockMetroPublisher */
        $mockMetroPublisher = $this->createMock(MetroPublisher::class);
        /** @var Slot $mockSlot */
        $mockSlot = $this->createMock(Slot::class);

        $embed = new EmbedSlotMedia($mockMetroPublisher, $mockSlot);
        $this->assertEquals(SlotMedia::TYPE_EMBED_CODE, $embed->getType());
    }

    public function testMetaFields() {
        $expected = [
            'embed_code',
            'content'
        ];

        $this->assertEquals($expected, EmbedSlotMedia::getMetaFields());
    }
}