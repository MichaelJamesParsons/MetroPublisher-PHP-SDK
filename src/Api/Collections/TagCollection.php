<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\AbstractResourceCollection;
use MetroPublisher\Api\Models\Tag;
use MetroPublisher\Api\ResourceCollectionInterface;

/**
 * Class TagCollection
 * @package MetroPublisher\Api\Collections
 */
class TagCollection extends AbstractResourceCollection implements ResourceCollectionInterface
{
    /**
     * @inheritdoc
     */
    public function findAll($page = 1, array $options = []) {
        return parent::all("/tags", $page, $options);
    }

    /**
     * @inheritdoc
     */
    public function find($uuid) {
        return parent::find("/tags/{$uuid}");
    }

    /**
     * @inheritdoc
     */
    protected function getModelClass()
    {
        return Tag::class;
    }
}