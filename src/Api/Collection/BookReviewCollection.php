<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\Models\BookReview;

/**
 * Class BookReviewCollection
 * @package MetroPublisher\Api\Collections
 */
class BookReviewCollection extends ContentCollection
{
    public function all($page = 1, array $options = [])
    {
        $options['ctypes'] = ContentCollection::TYPE_REVIEWS_BOOK;
        return parent::all($page, $options);
    }

    /**
     * @inheritdoc
     */
    protected function getModelClass()
    {
        return BookReview::class;
    }
}