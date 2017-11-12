<?php
namespace MetroPublisher\Api\Models;

use PHPUnit\Framework\TestCase;

/**
 * Class TagCategoryTest
 * @package Api\Models
 */
class TagCategoryTest extends TestCase
{
    public function testSave() {
        /** @var \PHPUnit_Framework_MockObject_MockObject|TagCategory $mockCategory */
        $mockCategory = $this->getMockBuilder(TagCategory::class)
                         ->setMethods(['doSave'])
                         ->disableOriginalConstructor()
                         ->getMock();

        $mockCategory->expects($this->once())
                 ->method('doSave')
                 ->willReturn(null)
                 ->with('/tags/categories/1');

        $mockCategory->setUuid('1')
                 ->save();
    }

    public function testDelete() {
        /** @var \PHPUnit_Framework_MockObject_MockObject|TagCategory $mockCategory */
        $mockCategory = $this->getMockBuilder(TagCategory::class)
                             ->setMethods(['doDelete'])
                             ->disableOriginalConstructor()
                             ->getMock();

        $mockCategory->expects($this->once())
                     ->method('doDelete')
                     ->willReturn(null)
                     ->with('/tags/categories/1');

        $mockCategory->setUuid('1')
                     ->delete();
    }

    public function testDefaultFields() {
        $expected = array_merge([
            'title',
            'urlname',
            'uuid',
            'created',
            'modified'
        ]);

        $this->assertEquals($expected, TagCategory::getDefaultFields());
    }
}