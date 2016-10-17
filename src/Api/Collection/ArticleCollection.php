<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\Models\Article;

/**
 * Class ArticleCollection
 * @package MetroPublisher\Api\Collections
 */
class ArticleCollection extends ContentCollection
{
    public function all($page = 1, array $options = [])
    {
        $options['ctypes'] = ContentCollection::TYPE_ARTICLES;
        return parent::all($page, $options);
    }

    protected function getModelClass()
    {
        return Article::class;
    }
}
