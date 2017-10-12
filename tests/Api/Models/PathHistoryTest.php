<?php
namespace MetroPublisher\Tests\Api\Models;

use MetroPublisher\Api\Models\PathHistory;
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