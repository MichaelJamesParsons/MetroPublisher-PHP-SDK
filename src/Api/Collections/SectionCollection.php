<?php

namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\AbstractResourceCollection;
use MetroPublisher\Api\Models\Section;
use MetroPublisher\Api\ResourceCollectionInterface;
use MetroPublisher\Api\ResourceModelInterface;

/**
 * Class SectionCollection
 * @package MetroPublisher\Api\Collections
 */
class SectionCollection extends AbstractResourceCollection implements ResourceCollectionInterface
{
    /**
     * Retrieves all of a resource model's records.
     *
     * @param int   $page
     * @param array $options
     *
     * @return ResourceModelInterface[]
     */
    public function findAll($page = 1, array $options = [])
    {
        return parent::all('/sections', $page, $options);
    }

    /**
     * @inheritdoc
     */
    public function find($uuid)
    {
        return parent::get("/sections/{$uuid}");
    }

    protected function getModelClass()
    {
        return Section::class;
    }
}