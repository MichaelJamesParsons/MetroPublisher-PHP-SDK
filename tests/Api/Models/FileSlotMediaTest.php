<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\MetroPublisher;
use PHPUnit\Framework\TestCase;

/**
 * Class FileSlotMediaTest
 * @package Api\Models
 */
class FileSlotMediaTest extends TestCase
{
    public function testSlotMediaType() {
        /** @var MetroPublisher $mockMetroPublisher */
        $mockMetroPublisher = $this->createMock(MetroPublisher::class);
        /** @var Slot $mockSlot */
        $mockSlot = $this->createMock(Slot::class);

        $fileMedia = new FileSlotMedia($mockMetroPublisher, $mockSlot);
        $this->assertEquals(SlotMedia::TYPE_FILE, $fileMedia->getType());
    }

    public function testMediaFields() {
        $expected = [
            'file_uuid',
            'image_uuid',
            'content'
        ];

        $this->assertEquals($expected, FileSlotMedia::getMetaFields());
    }
}