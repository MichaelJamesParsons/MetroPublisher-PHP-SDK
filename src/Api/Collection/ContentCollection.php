<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\AbstractQueryableCollection;
use MetroPublisher\Api\AbstractResourceCollection;
use MetroPublisher\Api\Models\Content;

/**
 * Class ContentCollection
 * @package MetroPublisher\Api
 */
class ContentCollection extends AbstractResourceCollection
{
    const TYPE_REVIEWS_BOOK = 'reviews_book';
    const TYPE_REVIEWS_ALBUM = 'reviews_album';
    const TYPE_REVIEWS_LOCATION = 'reviews_location';
    const TYPE_ROUNDUPS_LOCATION = 'roundups_location';
    const TYPE_ARTICLES = 'articles';

    public function all($page = 1, array $options = [])
    {
        return parent::all('/content', $page, $options);
    }

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