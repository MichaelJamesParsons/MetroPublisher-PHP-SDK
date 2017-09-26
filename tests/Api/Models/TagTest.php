<?php
namespace Api\Models;

use MetroPublisher\Api\Models\PathHistory;
use MetroPublisher\Api\Models\Tag;
use MetroPublisher\Http\HttpClientInterface;
use MetroPublisher\MetroPublisher;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class TagTest
 * @package Api\Models
 */
class TagTest extends TestCase
{
    public function testSave() {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Tag $mockSlot */
        $mockSlot = $this->getMockBuilder(Tag::class)
                         ->setMethods(['doSave'])
                         ->disableOriginalConstructor()
                         ->getMock();

        $mockSlot->expects($this->once())
                 ->method('doSave')
                 ->willReturn(null)
                 ->with('/tags/1');

        $mockSlot->setUuid('1')
                 ->save();
    }

    public function testDelete() {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Tag $mockSlot */
        $mockSlot = $this->getMockBuilder(Tag::class)
                         ->setMethods(['doDelete'])
                         ->disableOriginalConstructor()
                         ->getMock();

        $mockSlot->expects($this->once())
                 ->method('doDelete')
                 ->willReturn(null)
                 ->with('/tags/1');

        $mockSlot->setUuid('1')
                 ->delete();
    }

    public function testGetCategories() {
        $response = $this->getMockHttpResponse();
        $mockClient = $this->createMock(HttpClientInterface::class);
        $mockClient->expects($this->once())
                   ->method('get')
                   ->with('/tags/1/categories')
                   ->willReturn($response);

        $metroPublisher = new MetroPublisher(null, null, $mockClient);
        $tag = new Tag($metroPublisher);
        $tag->setUuid('1')
            ->getCategories();
    }

    public function testGetPathHistory() {
        $response = $this->getMockHttpResponse();
        $mockClient = $this->createMock(HttpClientInterface::class);
        $mockClient->expects($this->once())
                   ->method('get')
                   ->with('/tags/1/path_history')
                   ->willReturn($response);

        $metroPublisher = new MetroPublisher(null, null, $mockClient);
        $tag = new Tag($metroPublisher);
        $tag->setUuid('1')
            ->getPathHistory();
    }

    public function testSetPathHistory() {
        $response = $this->getMockHttpResponse();
        $mockClient = $this->createMock(HttpClientInterface::class);
        $mockClient->expects($this->once())
                   ->method('put')
                   ->with('/tags/1/path_history')
                   ->willReturn($response);

        $metroPublisher = new MetroPublisher(null, null, $mockClient);
        $tag = new Tag($metroPublisher);
        $tag->setUuid('1')
            ->setPathHistory([]);
    }

    public function testAddPathHistory() {
        /** @var \PHPUnit_Framework_MockObject_MockObject|MetroPublisher $mockMetroPublisher */
        $mockMetroPublisher = $this->createMock(MetroPublisher::class);
        $response = $this->getMockHttpResponse();
        $mockClient = $this->createMock(HttpClientInterface::class);
        $mockClient->expects($this->once())
                   ->method('post')
                   ->with('/tags/1/path_history')
                   ->willReturn($response);

        $metroPublisher = new MetroPublisher(null, null, $mockClient);
        $tag = new Tag($metroPublisher);
        $tag->setUuid('1')
            ->addPathHistory(new PathHistory($mockMetroPublisher, 'http://example.com'));
    }

    public function testDefaultFields() {
        $expected = [
            'last_name_or_title',
            'first_name',
            'description',
            'state',
            'synonyms',
            'content',
            'feature_image_uuid',
            'uuid',
            'urlname',
            'created',
            'modified'
        ];

        $this->assertEquals($expected, Tag::getDefaultFields());
    }

    private function getMockHttpResponse() {
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

        return $response;
    }
}