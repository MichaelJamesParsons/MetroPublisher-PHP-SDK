<?php

namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\Models\BookReview;
use MetroPublisher\Api\ResourceCollectionInterface;

/**
 * Class BookReviewCollection
 * @package MetroPublisher\Api\Collections
 */
class BookReviewCollection extends ContentCollection implements ResourceCollectionInterface
{
    /**
     * @inheritdoc
     */
    public function findAll($page = 1, array $options = [])
    {
        $options['ctypes'] = ContentCollection::TYPE_REVIEWS_BOOK;

        return parent::findAll($page, $options);
    }

    /**
     * @inheritdoc
     */
    protected function getModelClass()
    {
        return BookReview::class;
    }
}