<?php
namespace Api\Models;

use MetroPublisher\Api\Models\AlbumReview;
use MetroPublisher\Api\Models\Content;
use MetroPublisher\MetroPublisher;
use PHPUnit\Framework\TestCase;

/**
 * Class AlbumReviewTest
 * @package Api\Models
 */
class AlbumReviewTest extends TestCase
{
    public function testDefaultFields()
    {
        $expected = [
            'content_type',
            'title',
            'description',
            'state',
            'issued',
            'uuid',
            'urlname',
            'created',
            'modified'
        ];

        $this->assertEquals($expected, AlbumReview::getDefaultFields());
    }

    public function testMetaFields()
    {
        $expected = [
            'album_title',
            'album_image_uuid',
            'album_issued',
            'album_provider_urls',
            'album_buy_urls',
            'rating',
            'content',
            'meta_title',
            'meta_description',
            'print_description',
            'evergreen',
            'teaser_image_uuid',
            'feature_image_uuid'
        ];

        $this->assertEquals($expected, AlbumReview::getMetaFields());
    }

    public function testContentType() {
        /** @var MetroPublisher $mp */
        $mp = $this->createMock(MetroPublisher::class);
        $review = new AlbumReview($mp);
        $this->assertEquals(Content::CONTENT_TYPE_REVIEW_ALBUM, $review->getContentType());
    }
}