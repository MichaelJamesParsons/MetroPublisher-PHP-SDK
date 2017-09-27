<?php
namespace Api\Models;

use MetroPublisher\Api\Models\Location;
use PHPUnit\Framework\TestCase;

/**
 * Class LocationTest
 * @package Api\Models
 */
class LocationTest extends TestCase
{
    public function testMetaFields() {
        $expected = [
            'title',
            'description',
            'coords',
            'state',
            'thumb_uuid',
            'street',
            'streetnumber',
            'pcode',
            'geoname_id',
            'phone',
            'fax',
            'email',
            'website',
            'price_index',
            'opening_hours',
            'content',
            'closed',
            'print_description',
            'sort_title',
            'is_listing'
        ];

        $this->assertEquals($expected, Location::getMetaFields());
    }

    public function testSave() {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Location $mockLocation */
        $mockLocation = $this->getMockBuilder(Location::class)
            ->setMethods(['doSave'])
            ->disableOriginalConstructor()
            ->getMock();

        $mockLocation->expects($this->once())
                     ->method('doSave')
                     ->willReturn(null)
                     ->with('/locations/1');

        $mockLocation->setUuid('1');
        $mockLocation->save();
    }

    public function testDelete() {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Location $mockLocation */
        $mockLocation = $this->getMockBuilder(Location::class)
                             ->setMethods(['doDelete'])
                             ->disableOriginalConstructor()
                             ->getMock();

        $mockLocation->expects($this->once())
                     ->method('doDelete')
                     ->willReturn(null)
                     ->with('/locations/1');

        $mockLocation->setUuid('1');
        $mockLocation->delete();
    }
}