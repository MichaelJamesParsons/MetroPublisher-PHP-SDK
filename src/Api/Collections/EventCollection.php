<?php
namespace MetroPublisher\Api\Collections;

use DateTime;
use MetroPublisher\Api\Models\Event;
use MetroPublisher\Api\Models\EventOccurrence;
use MetroPublisher\Api\AbstractResourceCollection;
use MetroPublisher\Api\Models\Resolvers\ModelResolver;
use MetroPublisher\Api\ResourceCollectionInterface;
use MetroPublisher\Common\Serializers\ModelDeserializer;

/**
 * Class EventCollection
 * @package MetroPublisher\Api\Collections
 */
class EventCollection extends AbstractResourceCollection implements ResourceCollectionInterface
{
    /**
     * @inheritdoc
     */
    public function findAll($page = 1, array $options = [])
    {
        return parent::all('/content', $page, $options);
    }

    /**
     * @inheritdoc
     */
    public function find($uuid) {
        return parent::find("/content/{$uuid}");
    }

    /**
     * Retrieve the occurrences of events between two time periods.
     *
     * Both start and end are optional. If start is empty, all of the event
     * occurrences before the end date time will be returned. If only a start
     * time is set, all events after the start time will be returned.
     *
     * @param DateTime|null $start
     * @param DateTime|null $end
     * @param int           $page
     *
     * @return \MetroPublisher\Api\Models\AbstractModel[]
     */
    public function getOccurrences(DateTime $start = null, DateTime $end = null, $page = 1) {
        $occurrences = $this->context->get('/events', [
            'period' => sprintf('%s_%s', $start->format('Y-m-d'), $end->format('Y-m-d')),
            'page'   => $page
        ]);

        return ModelDeserializer::convertCollection(
            new ModelResolver(EventOccurrence::class),
            $occurrences,
            [$this->context]
        );
    }

    /**
     * @inheritdoc
     */
    protected function getModelClass()
    {
        return Event::class;
    }
}