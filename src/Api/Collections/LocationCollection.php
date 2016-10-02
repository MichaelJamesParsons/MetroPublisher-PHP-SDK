<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\AbstractResourceCollection;
use MetroPublisher\Api\Models\Location;

/**
 * Class LocationCollection
 * @package MetroPublisher\Api\Collections
 */
class LocationCollection extends AbstractResourceCollection
{

    protected function getModelClass()
    {
        return Location::class;
    }
}