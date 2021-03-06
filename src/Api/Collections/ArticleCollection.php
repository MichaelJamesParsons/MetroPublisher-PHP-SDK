<?php

namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\Models\AlbumReview;
use MetroPublisher\Api\Models\Article;
use MetroPublisher\Api\ResourceCollectionInterface;

/**
 * Class ArticleCollection
 * @package MetroPublisher\Api\Collections
 */
class ArticleCollection extends ContentCollection implements ResourceCollectionInterface
{
    /**
     * @inheritdoc
     *
     * @return AlbumReview[]
     */
    public function findAll($page = 1, array $options = [])
    {
        $options['ctypes'] = ContentCollection::TYPE_ARTICLES;

        return parent::findAll($page, $options);
    }

    /**
     * @inheritdoc
     */
    protected function getModelClass()
    {
        return Article::class;
    }
}
