<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\AbstractQueryableCollection;
use MetroPublisher\Api\Models\Location;

/**
 * Class LocationCollection
 * @package MetroPublisher\Api\Collections
 */
class LocationCollection extends AbstractQueryableCollection
{

    protected function getModelClass()
    {
        return Location::class;
    }
}