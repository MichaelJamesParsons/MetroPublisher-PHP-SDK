<?php
namespace MetroPublisher\Api\Models;

use DateTime;
use MetroPublisher\MetroPublisher;

/**
 * Class BookReview
 * @package MetroPublisher\Api\Models
 */
class BookReview extends AbstractReview
{
    /** @var  string */
    protected $book_title;

    /** @var  string */
    protected $book_image_uuid;

    /** @var  string */
    protected $book_isbn;

    /** @var  DateTime */
    protected $book_issued;

    /** @var  array */
    protected $book_provider_urls;

    /** @var  array */
    protected $book_buy_urls;

    /**
     * BookReview constructor.
     *
     * @param MetroPublisher $metroPublisher
     */
    public function __construct(MetroPublisher $metroPublisher)
    {
        parent::__construct($metroPublisher);
        $this->properties['content_type'] = Content::CONTENT_TYPE_REVIEW_BOOK;
    }

    /**
     * @return string
     */
    public function getBookTitle()
    {
        return $this->book_title;
    }

    /**
     * @param string $book_title
     *
     * @return $this
     */
    public function setBookTitle($book_title)
    {
        $this->book_title = $book_title;

        return $this;
    }

    /**
     * @return string
     */
    public function getBookImageUuid()
    {
        return $this->book_image_uuid;
    }

    /**
     * @param string $book_image_uuid
     *
     * @return $this
     */
    public function setBookImageUuid($book_image_uuid)
    {
        $this->book_image_uuid = $book_image_uuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getBookIsbn()
    {
        return $this->book_isbn;
    }

    /**
     * @param string $book_isbn
     *
     * @return $this
     */
    public function setBookIsbn($book_isbn)
    {
        $this->book_isbn = $book_isbn;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getBookIssued()
    {
        return $this->book_issued;
    }

    /**
     * @param DateTime $book_issued
     *
     * @return $this
     */
    public function setBookIssued($book_issued)
    {
        $this->book_issued = $book_issued;

        return $this;
    }

    /**
     * @return \string[]
     */
    public function getBookProviderUrls()
    {
        return $this->book_provider_urls;
    }

    /**
     * @param \string[] $book_provider_urls
     *
     * @return $this
     */
    public function setBookProviderUrls($book_provider_urls)
    {
        $this->book_provider_urls = $book_provider_urls;

        return $this;
    }

    /**
     * @return \string[]
     */
    public function getBookBuyUrls()
    {
        return $this->book_buy_urls;
    }

    /**
     * @param \string[] $book_buy_urls
     *
     * @return $this
     */
    public function setBookBuyUrls($book_buy_urls)
    {
        $this->book_buy_urls = $book_buy_urls;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public static function getDefaultFields() {
        return array_merge([

        ], parent::getDefaultFields());
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