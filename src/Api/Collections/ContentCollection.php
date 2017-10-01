<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\Models\Content;
use MetroPublisher\Api\AbstractResourceCollection;
use MetroPublisher\Api\ResourceCollectionInterface;

/**
 * Class ContentCollection
 * @package MetroPublisher\Api
 */
class ContentCollection extends AbstractResourceCollection implements ResourceCollectionInterface
{
    const TYPE_REVIEWS_BOOK = 'reviews_book';
    const TYPE_REVIEWS_ALBUM = 'reviews_album';
    const TYPE_REVIEWS_LOCATION = 'reviews_location';
    const TYPE_ROUNDUPS_LOCATION = 'roundups_location';
    const TYPE_ARTICLES = 'articles';

    /**
     * @inheritdoc
     */
    public function findAll($page = 1, array $options = [])
    {
        return parent::all('/content', $page, $options);
    }

    /**
     * @inheritdoc
     */
    public function find($uuid) {
        return parent::find("/content/{$uuid}");
    }

    /**
     * @inheritdoc
     */
    protected function getModelClass()
    {
        return Content::class;
    }
}