<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\AbstractResourceCollection;
use MetroPublisher\Api\Models\AlbumReview;

/**
 * Class AlbumReviewCollection
 * @package MetroPublisher\Api\Collections
 */
class AlbumReviewCollection extends AbstractResourceCollection
{
    /**
     * @inheritdoc
     */
    public function all($page = 1, array $options = [])
    {
        $options['ctypes'] = 'albums';
        return parent::all($page, $options);
    }

    /**
     * @inheritdoc
     */
    protected function getModelClass()
    {
        return AlbumReview::class;
    }
}