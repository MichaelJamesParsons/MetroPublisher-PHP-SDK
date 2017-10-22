<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\Models\AlbumReview;

/**
 * Class AlbumReviewCollection
 * @package MetroPublisher\Api\Collections
 */
class AlbumReviewCollection extends ContentCollection
{
    /**
     * @inheritdoc
     */
    public function findAll($page = 1, array $options = [])
    {
        $options['ctypes'] = ContentCollection::TYPE_REVIEWS_ALBUM;
        return parent::findAll($page, $options);
    }

    /**
     * @inheritdoc
     */
    protected function getModelClass()
    {
        return AlbumReview::class;
    }
}