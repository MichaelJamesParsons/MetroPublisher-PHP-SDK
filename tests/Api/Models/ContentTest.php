<?php

namespace MetroPublisher\Api\Models;

use MetroPublisher\MetroPublisher;
use PHPUnit\Framework\TestCase;

class ContentTest extends TestCase
{
    public function testDefaultFields()
    {
        $expectedFields = [
            'content_type',
            'title',
            'urlname',
            'description',
            'state',
            'issued',
            'uuid',
            'created',
            'modified'
        ];
        $this->assertEquals($expectedFields, Content::getDefaultFields());
    }

    public function testMetaFields()
    {
        $expectedFields = [
            'content',
            'meta_title',
            'meta_description',
            'print_description',
            'evergreen',
            'teaser_image_uuid',
            'feature_image_uuid',
            'section_uuid'
        ];

        $this->assertEquals($expectedFields, Content::getMetaFields());
    }

    public function testSaveRoute()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Content $content */
        $content = $this->getMockBuilder(Content::class)
                        ->setMethods(['doSave'])
                        ->setConstructorArgs([new MetroPublisher(null, null), '1'])
                        ->getMock();

        $content->expects($this->once())
                ->method('doSave')
                ->with($this->equalTo('/content/1'))
                ->willReturn(null);

        $content->save();
    }

    public function testDeleteRoute()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Content $content */
        $content = $this->getMockBuilder(Content::class)
                        ->setMethods(['doDelete'])
                        ->setConstructorArgs([new MetroPublisher(null, null), 1])
                        ->getMock();

        $content->expects($this->once())
                ->method('doDelete')
                ->with($this->equalTo('/content/1'))
                ->willReturn(null);

        $content->delete();
    }
}