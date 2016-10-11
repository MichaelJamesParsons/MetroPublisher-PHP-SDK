<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\AbstractQueryableCollection;
use MetroPublisher\Api\Models\Event;

/**
 * Class EventCollection
 * @package MetroPublisher\Api\Collections
 */
class EventCollection extends AbstractQueryableCollection
{

    protected function getModelClass()
    {
        return Event::class;
    }
}