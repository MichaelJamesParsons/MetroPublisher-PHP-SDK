<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\AbstractResourceCollection;
use MetroPublisher\Api\Content;

/**
 * Class ContentCollection
 * @package MetroPublisher\Api
 */
class ContentCollection extends AbstractResourceCollection
{
    public function all($model, $page = 1, array $options = [])
    {
        return parent::all('/content', $page, $options);
    }

    public function find($model, $uuid) {
        return parent::find("/content/{$uuid}");
    }

    public function findBy($model, array $fields, $page = 1, array $options = [])
    {
        $response = parent::findBy("/content", $fields, $page, $options);

        if(!empty($response['items'])) {

        }

        return [];
    }

    protected function getModelClass()
    {
        return Content::class;
    }
}