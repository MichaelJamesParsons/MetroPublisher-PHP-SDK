<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\AbstractResourceCollection;
use MetroPublisher\Api\Models\Tag;

/**
 * Class TagCollection
 * @package MetroPublisher\Api\Collections
 */
class TagCollection extends AbstractResourceCollection
{
    /**
     * @inheritdoc
     */
    public function all() {
        return parent::all("/tags");
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