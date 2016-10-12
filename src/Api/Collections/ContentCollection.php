<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\AbstractQueryableCollection;
use MetroPublisher\Api\Content;

/**
 * Class ContentCollection
 * @package MetroPublisher\Api
 */
class ContentCollection extends AbstractQueryableCollection
{
    public function all($page = 1, array $options = [])
    {
        return parent::all('/content', $page, $options);
    }

    public function find($uuid) {
        return parent::find("/content/{$uuid}");
    }

    public function findBy(array $fields, $page = 1, array $options = [])
    {
        return parent::findBy("/content", $fields, $page, $options);
    }

    protected function getModelClass()
    {
        return Content::class;
    }
}