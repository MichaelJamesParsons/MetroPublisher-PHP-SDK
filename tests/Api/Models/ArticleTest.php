<?php
namespace Api\Models;

use MetroPublisher\Api\Models\Article;
use MetroPublisher\Api\Models\Content;
use MetroPublisher\MetroPublisher;
use PHPUnit\Framework\TestCase;

/**
 * Class ArticleTest
 * @package Api\Models
 */
class ArticleTest extends TestCase
{
    public function testContentType() {
        /** @var MetroPublisher $metroPublisher */
        $metroPublisher = $this->createMock(MetroPublisher::class);
        $article = new Article($metroPublisher);
        $this->assertEquals(Content::CONTENT_TYPE_ARTICLE, $article->getContentType());
    }
}