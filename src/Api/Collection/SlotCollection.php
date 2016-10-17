<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\AbstractResourceCollection;
use MetroPublisher\Api\Models\Content;
use MetroPublisher\Api\Models\Slot;
use MetroPublisher\MetroPublisher;

/**
 * Class SlotCollection
 * @package MetroPublisher\Api\Collections
 *
 * @todo Consider converting this into an AbstractQueryableCollection
 */
class SlotCollection extends AbstractResourceCollection
{
    /** @var  Content $content */
    private $content;

    /**
     * SlotCollection constructor.
     *
     * @param MetroPublisher $metroPublisher
     * @param Content        $content
     */
    public function __construct(MetroPublisher $metroPublisher, Content $content)
    {
        parent::__construct($metroPublisher);
        $this->content = $content;
    }

    public function all() {
        $response = $this->client->get(
            sprintf('%s/content/%s/slots', $this->getBaseUri(), $this->content->getUuid())
        );

        return $this->serializer->serializeArrayCollectionToObjects(
            $this->getModelClass(),
            $this->getModelDefaultFields(),
            $response['items']
        );
    }

    public function find(Slot $slot) {
        $result = $this->client->get(
            sprintf('%s/content/%s/slots/%s', $this->getBaseUri(), $this->content->getUuid(), $slot->getUuid())
        );

        $slot = $this->serializer->serializeArrayToObject(
            $this->getModelClass(),
            $this->getModelDefaultFields(),
            $result
        );

        return $slot;
    }

    /**
     * @inheritdoc
     */
    public function getModelClass()
    {
        return Slot::class;
    }
}