<?php

namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\Models\Exception\ModelValidationException;
use MetroPublisher\MetroPublisher;
use PHPUnit\Framework\TestCase;

/**
 * Class SlotMediaTest
 * @package Api\Models
 */
class SlotMediaTest extends TestCase
{
    public function testSave()
    {
        $mp = new MetroPublisher(null, null);

        /** @var \PHPUnit_Framework_MockObject_MockObject|SlotMedia $mockSlot */
        $mockSlot = $this->getMockBuilder(SlotMedia::class)
                         ->setMethods(['doSave'])
                         ->setConstructorArgs([$mp, new Slot($mp, '3'), '2'])
                         ->getMock();

        $mockSlot->expects($this->once())
                 ->method('doSave')
                 ->willReturn(null)
                 ->with('/content/2/slots/3/media');

        $mockSlot->setContentUuid('2')
                 ->setSlotUuid('3')
                 ->save();
    }

    public function testSaveWithoutSlotUuid()
    {
        $mp = new MetroPublisher(null, null);

        $this->expectException(ModelValidationException::class);

        /** @var \PHPUnit_Framework_MockObject_MockObject|SlotMedia $mockSlot */
        $mockSlot = $this->getMockBuilder(SlotMedia::class)
                         ->setMethods(['doSave'])
                         ->setConstructorArgs([$mp, new Slot($mp, null), '1'])
                         ->getMock();

        $mockSlot->expects($this->never())
                 ->method('doSave')
                 ->willReturn(null);

        $mockSlot->setContentUuid('2')
                 ->save();
    }

    public function testSaveWithoutContentUuid()
    {
        $mp = new MetroPublisher(null, null);

        $this->expectException(ModelValidationException::class);

        /** @var \PHPUnit_Framework_MockObject_MockObject|SlotMedia $mockSlot */
        $mockSlot = $this->getMockBuilder(SlotMedia::class)
                         ->setMethods(['doSave'])
                         ->setConstructorArgs([$mp, new Slot($mp, '2'), '1'])
                         ->getMock();

        $mockSlot->expects($this->never())
                 ->method('doSave')
                 ->willReturn(null);

        $mockSlot->setSlotUuid('2')
                 ->save();
    }

    public function testDelete()
    {
        $mp = new MetroPublisher(null, null);

        /** @var \PHPUnit_Framework_MockObject_MockObject|SlotMedia $mockSlot */
        $mockSlot = $this->getMockBuilder(SlotMedia::class)
                         ->setMethods(['doDelete'])
                         ->setConstructorArgs([$mp, new Slot($mp, '2'), '1'])
                         ->getMock();

        $mockSlot->expects($this->once())
                 ->method('doDelete')
                 ->willReturn(null)
                 ->with('/content/2/slots/3/media');

        $mockSlot->setContentUuid('2')
                 ->setSlotUuid('3')
                 ->delete();
    }

    public function testDeleteWithoutSlotUuid()
    {
        $mp = new MetroPublisher(null, null);
        $this->expectException(ModelValidationException::class);

        /** @var \PHPUnit_Framework_MockObject_MockObject|SlotMedia $mockSlot */
        $mockSlot = $this->getMockBuilder(SlotMedia::class)
                         ->setMethods(['doDelete'])
                         ->setConstructorArgs([$mp, new Slot($mp, null), '1'])
                         ->getMock();

        $mockSlot->expects($this->never())
                 ->method('doDelete')
                 ->willReturn(null);

        $mockSlot->setContentUuid('2')
                 ->delete();
    }

    public function testDeleteWithoutContentUuid()
    {
        $mp = new MetroPublisher(null, null);
        $this->expectException(ModelValidationException::class);

        /** @var \PHPUnit_Framework_MockObject_MockObject|SlotMedia $mockSlot */
        $mockSlot = $this->getMockBuilder(SlotMedia::class)
                         ->setMethods(['doDelete'])
                         ->setConstructorArgs([$mp, new Slot($mp, '2'), null])
                         ->getMock();

        $mockSlot->expects($this->never())
                 ->method('doDelete')
                 ->willReturn(null);

        $mockSlot->setSlotUuid('2')
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