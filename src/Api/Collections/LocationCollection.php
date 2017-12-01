<?php

namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\AbstractResourceCollection;
use MetroPublisher\Api\Models\Location;
use MetroPublisher\Api\ResourceCollectionInterface;

class LocationCollection extends AbstractResourceCollection implements ResourceCollectionInterface
{
    /**
     * @inheritdoc
     */
    public function findAll($page = 1, array $options = [])
    {
        return parent::all('/locations', $page, $options);
    }

    /**
     * @inheritdoc
     */
    public function find($uuid)
    {
        return parent::get("/locations/{$uuid}");
    }

    protected function getModelClass()
    {
        return Location::class;
    }
}