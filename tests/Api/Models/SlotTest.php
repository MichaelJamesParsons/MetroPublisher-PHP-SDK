<?php

namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\Models\Exception\ModelValidationException;
use MetroPublisher\MetroPublisher;
use PHPUnit\Framework\TestCase;

/**
 * Class SlotTest
 * @package Api\Models
 */
class SlotTest extends TestCase
{
    public function testSave()
    {
        $mockMetroPublisher = $this->createMock(MetroPublisher::class);

        /** @var \PHPUnit_Framework_MockObject_MockObject|Slot $mockSlot */
        $mockSlot = $this->getMockBuilder(Slot::class)
                         ->setMethods(['doSave'])
                         ->setConstructorArgs([$mockMetroPublisher, '1'])
                         ->getMock();

        $mockSlot->expects($this->once())
                 ->method('doSave')
                 ->willReturn(null)
                 ->with('/content/2/slots/1');

        $mockSlot->setContentUuid('2')
                 ->save();
    }

    public function testSaveWithoutContentUuid()
    {
        $this->expectException(ModelValidationException::class);

        /** @var \PHPUnit_Framework_MockObject_MockObject|Slot $mockSlot */
        $mockSlot = $this->getMockBuilder(Slot::class)
                         ->setMethods(['doSave'])
                         ->setConstructorArgs([new MetroPublisher(null, null), null])
                         ->getMock();

        $mockSlot->expects($this->never())
                 ->method('doSave')
                 ->willReturn(null)
                 ->with('/content/2/slots/1');

        $mockSlot->save();
    }

    public function testDelete()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Slot $mockSlot */
        $mockSlot = $this->getMockBuilder(Slot::class)
                         ->setMethods(['doDelete'])
                         ->setConstructorArgs([new MetroPublisher(null, null), '1'])
                         ->getMock();

        $mockSlot->expects($this->once())
                 ->method('doDelete')
                 ->willReturn(null)
                 ->with('/content/2/slots/1');

        $mockSlot->setContentUuid('2')
                 ->delete();
    }

    public function testDeleteWithoutContentUuid()
    {
        $this->expectException(ModelValidationException::class);

        /** @var \PHPUnit_Framework_MockObject_MockObject|Slot $mockSlot */
        $mockSlot = $this->getMockBuilder(Slot::class)
                         ->setMethods(['doDelete'])
                         ->setConstructorArgs([new MetroPublisher(null, null), '1'])
                         ->getMock();

        $mockSlot->expects($this->never())
                 ->method('doDelete')
                 ->willReturn(null)
                 ->with('/content/2/slots/1');

        $mockSlot->delete();
    }

    public function testGetMedia()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|MetroPublisher $mockMetroPublisher */
        $mockMetroPublisher = $this->getMockBuilder(MetroPublisher::class)
                                   ->setConstructorArgs([null, null])
                                   ->setMethods(['get'])
                                   ->getMock();

        $mockMetroPublisher->expects($this->once())
                           ->method('get')
                           ->with('/content/2/slots/1/media')
                           ->willReturn([]);

        $slot = new Slot($mockMetroPublisher, '1');
        $slot->setContentUuid(2);
        $slot->getMedia();
    }

    public function testDefaultFields()
    {
        $expects = [
            'url',
            'content_uuid',
            'relevance',
            'display',
            'content_url',
            'content_uuid',
            'uuid',
            'created',
            'modified'
        ];

        $this->assertEquals($expects, Slot::getDefaultFields());
    }
}