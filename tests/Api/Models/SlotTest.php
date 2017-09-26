<?php
namespace Api\Models;

use MetroPublisher\Api\Models\Exception\ModelValidationException;
use MetroPublisher\Api\Models\Slot;
use MetroPublisher\Http\HttpClientInterface;
use MetroPublisher\MetroPublisher;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class SlotTest
 * @package Api\Models
 */
class SlotTest extends TestCase
{
    public function testSave() {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Slot $mockSlot */
        $mockSlot = $this->getMockBuilder(Slot::class)
            ->setMethods(['doSave'])
            ->disableOriginalConstructor()
            ->getMock();

        $mockSlot->expects($this->once())
            ->method('doSave')
            ->willReturn(null)
            ->with('/content/2/slots/1');

        $mockSlot->setUuid('1')
                 ->setContentUuid('2')
                 ->save();
    }

    public function testSaveWithoutContentUuid() {
        $this->expectException(ModelValidationException::class);

        /** @var \PHPUnit_Framework_MockObject_MockObject|Slot $mockSlot */
        $mockSlot = $this->getMockBuilder(Slot::class)
                         ->setMethods(['doSave'])
                         ->disableOriginalConstructor()
                         ->getMock();

        $mockSlot->expects($this->never())
                 ->method('doSave')
                 ->willReturn(null)
                 ->with('/content/2/slots/1');

        $mockSlot->setUuid('1')
                 ->save();
    }

    public function testDelete() {
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

    public function testDeleteWithoutContentUuid() {
        $this->expectException(ModelValidationException::class);

        /** @var \PHPUnit_Framework_MockObject_MockObject|Slot $mockSlot */
        $mockSlot = $this->getMockBuilder(Slot::class)
                         ->setMethods(['doDelete'])
                         ->disableOriginalConstructor()
                         ->getMock();

        $mockSlot->expects($this->never())
                 ->method('doDelete')
                 ->willReturn(null)
                 ->with('/content/2/slots/1');

        $mockSlot->setUuid('1')
                 ->delete();
    }

    public function testGetMedia() {
        $mockStream = $this->createMock(StreamInterface::class);
        $mockStream->expects($this->once())
            ->method('getContents')
            ->willReturn('[]');

        $response = $this->createMock(ResponseInterface::class);
        $response->expects($this->once())
            ->method('getBody')
            ->willReturn($mockStream);

        // Set content type as json
        $response->expects($this->once())
            ->method('getHeader')
            ->with('Content-Type')
            ->willReturn('application/json');

        // Return 200 status code
        $response->expects($this->once())
             ->method('getStatusCode')
             ->willReturn(200);

        $mockClient = $this->createMock(HttpClientInterface::class);
        $mockClient->expects($this->once())
            ->method('get')
            ->willReturn($response);

        $metroPublisher = new MetroPublisher(null, null, $mockClient);
        $slot = new Slot($metroPublisher);
        $slot->getMedia();
    }

    public function testDefaultFields() {
        $expects = [
            'url',
            'content_uuid',
            'relevance',
            'display',
            'content_url',
            'content_uuid',
            'uuid',
            'urlname',
            'created',
            'modified'
        ];

        $this->assertEquals($expects, Slot::getDefaultFields());
    }
}