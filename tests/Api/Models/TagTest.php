<?php

namespace MetroPublisher\Api\Models;

use MetroPublisher\MetroPublisher;
use PHPUnit\Framework\TestCase;

/**
 * Class TagTest
 * @package Api\Models
 */
class TagTest extends TestCase
{
    public function testSave()
    {
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

    public function testDelete()
    {
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

    public function testGetCategories()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|MetroPublisher $mockMetroPublisher */
        $mockMetroPublisher = $this->getMockBuilder(MetroPublisher::class)
                                   ->setConstructorArgs([null, null])
                                   ->setMethods(['get'])
                                   ->getMock();

        $mockMetroPublisher->expects($this->once())
                           ->method('get')
                           ->with('/tags/1/categories')
                           ->willReturn([]);

        $tag = new Tag($mockMetroPublisher);
        $tag->setUuid('1')
            ->getCategories();
    }

    public function testGetPathHistory()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|MetroPublisher $mockMetroPublisher */
        $mockMetroPublisher = $this->getMockBuilder(MetroPublisher::class)
                                   ->setConstructorArgs([null, null])
                                   ->setMethods(['get'])
                                   ->getMock();

        $mockMetroPublisher->expects($this->once())
                           ->method('get')
                           ->with('/tags/1/path_history')
                           ->willReturn([]);

        $tag = new Tag($mockMetroPublisher);
        $tag->setUuid('1')
            ->getPathHistory();
    }

    public function testSetPathHistory()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|MetroPublisher $mockMetroPublisher */
        $mockMetroPublisher = $this->getMockBuilder(MetroPublisher::class)
                                   ->setConstructorArgs([null, null])
                                   ->setMethods(['put'])
                                   ->getMock();

        $mockMetroPublisher->expects($this->once())
                           ->method('put')
                           ->with('/tags/1/path_history', ['items' => []])
                           ->willReturn([]);

        $tag = new Tag($mockMetroPublisher);
        $tag->setUuid('1')
            ->setPathHistory([]);
    }

    public function testAddPathHistory()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|MetroPublisher $mockMetroPublisher */
        $mockMetroPublisher = $this->getMockBuilder(MetroPublisher::class)
                                   ->setConstructorArgs([null, null])
                                   ->setMethods(['post'])
                                   ->getMock();

        $mockMetroPublisher->expects($this->once())
                           ->method('post')
                           ->with('/tags/1/path_history', ['path' => 'http://example.com'])
                           ->willReturn([]);

        $tag = new Tag($mockMetroPublisher);
        $tag->setUuid('1')
            ->addPathHistory(new PathHistory($mockMetroPublisher, 'http://example.com'));
    }

    public function testDefaultFields()
    {
        $expected = [
            'last_name_or_title',
            'first_name',
            'description',
            'state',
            'synonyms',
            'content',
            'urlname',
            'feature_image_uuid',
            'uuid',
            'created',
            'modified'
        ];

        $this->assertEquals($expected, Tag::getDefaultFields());
    }
}