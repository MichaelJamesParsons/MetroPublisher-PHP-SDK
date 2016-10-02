<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\AbstractResourceCollection;
use MetroPublisher\Api\Models\Event;

/**
 * Class EventCollection
 * @package MetroPublisher\Api\Collections
 */
class EventCollection extends AbstractResourceCollection
{

    protected function getModelClass()
    {
        return Event::class;
    }
}