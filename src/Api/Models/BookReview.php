<?php
namespace MetroPublisher\Api\Models;

use DateTime;
use MetroPublisher\MetroPublisher;

/**
 * Class BookReview
 * @package MetroPublisher\Api\Models
 *
 * @property string     $book_title
 * @property string     $book_image_uuid
 * @property string     $book_isbn
 * @property DateTime   $book_issued
 * @property array      $book_provider_urls
 * @property array      $book_buy_urls
 */
class BookReview extends AbstractReview
{
    /**
     * BookReview constructor.
     *
     * @param MetroPublisher $metroPublisher
     */
    public function __construct(MetroPublisher $metroPublisher)
    {
        parent::__construct($metroPublisher);
        $this->content_type = Content::CONTENT_TYPE_REVIEW_BOOK;
    }

    /**
     * @inheritdoc
     */
    public static function getMetaFields()
    {
        return array_merge([
            'book_title',
            'book_image_uuid',
            'book_isbn',
            'book_issued',
            'book_provider_urls',
            'book_buy_urls'
        ], parent::getMetaFields());
    }
}