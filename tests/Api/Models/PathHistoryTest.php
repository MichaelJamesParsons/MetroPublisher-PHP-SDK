<?php
namespace MetroPublisher\Api\Models;

use PHPUnit\Framework\TestCase;

/**
 * Class PathHistoryTest
 * @package Api\Models
 */
class PathHistoryTest extends TestCase
{
    public function testFieldNames() {
        $expected = ['path'];
        $this->assertEquals($expected, PathHistory::getFieldNames());
    }
}