<?php

namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\Models\Exception\ModelValidationException;
use PHPUnit\Framework\TestCase;

/**
 * Class SlotMediaTest
 * @package Api\Models
 */
class SlotMediaTest extends TestCase
{
    public function testSave()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|SlotMedia $mockSlot */
        $mockSlot = $this->getMockBuilder(SlotMedia::class)
                         ->setMethods(['doSave'])
                         ->disableOriginalConstructor()
                         ->getMock();

        $mockSlot->expects($this->once())
                 ->method('doSave')
                 ->willReturn(null)
                 ->with('/content/2/slots/3/media');

        $mockSlot->setUuid('1')
                 ->setContentUuid('2')
                 ->setSlotUuid('3')
                 ->save();
    }

    public function testSaveWithoutSlotUuid()
    {
        $this->expectException(ModelValidationException::class);

        /** @var \PHPUnit_Framework_MockObject_MockObject|SlotMedia $mockSlot */
        $mockSlot = $this->getMockBuilder(SlotMedia::class)
                         ->setMethods(['doSave'])
                         ->disableOriginalConstructor()
                         ->getMock();

        $mockSlot->expects($this->never())
                 ->method('doSave')
                 ->willReturn(null);

        $mockSlot->setUuid('1')
                 ->setContentUuid('2')
                 ->save();
    }

    public function testSaveWithoutContentUuid()
    {
        $this->expectException(ModelValidationException::class);

        /** @var \PHPUnit_Framework_MockObject_MockObject|SlotMedia $mockSlot */
        $mockSlot = $this->getMockBuilder(SlotMedia::class)
                         ->setMethods(['doSave'])
                         ->disableOriginalConstructor()
                         ->getMock();

        $mockSlot->expects($this->never())
                 ->method('doSave')
                 ->willReturn(null);

        $mockSlot->setUuid('1')
                 ->setSlotUuid('2')
                 ->save();
    }

    public function testDelete()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|SlotMedia $mockSlot */
        $mockSlot = $this->getMockBuilder(SlotMedia::class)
                         ->setMethods(['doDelete'])
                         ->disableOriginalConstructor()
                         ->getMock();

        $mockSlot->expects($this->once())
                 ->method('doDelete')
                 ->willReturn(null)
                 ->with('/content/2/slots/3/media');

        $mockSlot->setUuid('1')
                 ->setContentUuid('2')
                 ->setSlotUuid('3')
                 ->delete();
    }

    public function testDeleteWithoutSlotUuid()
    {
        $this->expectException(ModelValidationException::class);

        /** @var \PHPUnit_Framework_MockObject_MockObject|SlotMedia $mockSlot */
        $mockSlot = $this->getMockBuilder(SlotMedia::class)
                         ->setMethods(['doDelete'])
                         ->disableOriginalConstructor()
                         ->getMock();

        $mockSlot->expects($this->never())
                 ->method('doDelete')
                 ->willReturn(null);

        $mockSlot->setUuid('1')
                 ->setContentUuid('2')
                 ->delete();
    }

    public function testDeleteWithoutContentUuid()
    {
        $this->expectException(ModelValidationException::class);

        /** @var \PHPUnit_Framework_MockObject_MockObject|SlotMedia $mockSlot */
        $mockSlot = $this->getMockBuilder(SlotMedia::class)
                         ->setMethods(['doDelete'])
                         ->disableOriginalConstructor()
                         ->getMock();

        $mockSlot->expects($this->never())
                 ->method('doDelete')
                 ->willReturn(null);

        $mockSlot->setUuid('1')
                 ->setSlotUuid('2')
                 ->delete();
    }

    public function testDefaultFields()
    {
        $expected = [
            'type',
            'title',
            'thumb_uuid',
            'slot_uuid',
            'content_uuid',
            'uuid',
            'created',
            'modified'
        ];

        $this->assertEquals($expected, SlotMedia::getDefaultFields());
    }

    public function testMetaFields()
    {
        $expected = ['content'];
        $this->assertEquals($expected, SlotMedia::getMetaFields());
    }
}