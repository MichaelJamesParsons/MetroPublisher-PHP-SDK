<?php

namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\Models\Exception\ModelValidationException;
use MetroPublisher\Api\SlotContentInterface;
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
        $mockSlotContent = $this->createMock(SlotContentInterface::class);
        $mockMetroPublisher = $this->createMock(MetroPublisher::class);

        /** @var \PHPUnit_Framework_MockObject_MockObject|Slot $mockSlot */
        $mockSlot = $this->getMockBuilder(Slot::class)
                         ->setMethods(['doSave'])
                         ->setConstructorArgs([$mockMetroPublisher, $mockSlotContent])
                         ->getMock();

        $mockSlot->expects($this->once())
                 ->method('doSave')
                 ->willReturn(null)
                 ->with('/content/2/slots/1');

        $mockSlot->setUuid('1')
                 ->setContentUuid('2')
                 ->save();
    }

    public function testDelete()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Slot $mockSlot */
        $mockSlot = $this->getMockBuilder(Slot::class)
                         ->setMethods(['doDelete'])
                         ->disableOriginalConstructor()
                         ->getMock();

        $mockSlot->expects($this->once())
                 ->method('doDelete')
                 ->willReturn(null)
                 ->with('/content/2/slots/1');

        $mockSlot->setUuid('1')
                 ->setContentUuid('2')
                 ->delete();
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

        $content = new Article($mockMetroPublisher);
        $content->setUuid('2');

        $slot = new Slot($mockMetroPublisher, $content);
        $slot->setUuid(1)
             ->getMedia();
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