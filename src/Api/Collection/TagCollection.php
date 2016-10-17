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
    protected function getModelClass()
    {
        return Tag::class;
    }
}