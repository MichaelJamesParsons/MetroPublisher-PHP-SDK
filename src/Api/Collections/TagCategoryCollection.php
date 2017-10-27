<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\AbstractResourceCollection;
use MetroPublisher\Api\Models\TagCategory;

/**
 * Class TagCategoryCollection
 * @package MetroPublisher\Api\Collections
 */
class TagCategoryCollection extends AbstractResourceCollection
{
    /**
     * @inheritdoc
     */
    public function findAll($page = 1, array $options = []) {
        return parent::all("/tags/categories", $page, $options);
    }

    /**
     * @inheritdoc
     */
    public function find($uuid) {
        return parent::get("/tags/categories/{$uuid}");
    }

    /**
     * @inheritdoc
     */
    protected function getModelClass()
    {
        return TagCategory::class;
    }
}