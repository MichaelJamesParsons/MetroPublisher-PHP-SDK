<?php
namespace MetroPublisher\Tests\Api\Models;

use MetroPublisher\Api\Models\BookReview;
use MetroPublisher\Api\Models\Content;
use MetroPublisher\MetroPublisher;
use PHPUnit\Framework\TestCase;

/**
 * Class BookReviewTest
 * @package Api\Models
 */
class BookReviewTest extends TestCase
{
    public function testContentType() {
        /** @var MetroPublisher $metroPublisher */
        $metroPublisher = $this->createMock(MetroPublisher::class);
        $bookReview = new BookReview($metroPublisher);
        $this->assertEquals(Content::CONTENT_TYPE_REVIEW_BOOK, $bookReview->getContentType());
    }

    public function testMetaFields() {
        $expected = [
            'book_title',
            'book_image_uuid',
            'book_isbn',
            'book_issued',
            'book_provider_urls',
            'book_buy_urls',
            'rating',
            'content',
            'meta_title',
            'meta_description',
            'print_description',
            'evergreen',
            'teaser_image_uuid',
            'feature_image_uuid'
        ];

        $this->assertEquals($expected, BookReview::getMetaFields());
    }

    public function testAddBookBuyUrl() {
        /** @var MetroPublisher $metroPublisher */
        $metroPublisher = $this->createMock(MetroPublisher::class);
        $bookReview = new BookReview($metroPublisher);

        // Test default value
        $this->assertEquals([], $bookReview->getBookBuyUrls());

        // Test added value
        $bookReview->addBookBuyUrl('http://metropublisher.com');
        $this->assertEquals(['http://metropublisher.com'], $bookReview->getBookBuyUrls());
    }
}