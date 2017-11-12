<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\MetroPublisher;
use MetroPublisher\Api\Models\Slot;
use MetroPublisher\Api\Models\Content;
use MetroPublisher\Api\AbstractResourceCollection;
use MetroPublisher\Api\ResourceCollectionInterface;

/**
 * Class SlotCollection
 * @package MetroPublisher\Api\Collections
 */
class SlotCollection extends AbstractResourceCollection implements ResourceCollectionInterface
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

    public function findAll($page = 1, array $options = []) {
        return parent::all(sprintf('/content/%s/slots', $this->content->getUuid()));
    }

    public function find($slotUuid) {
        return parent::get(
            sprintf("/content/%s/slots/%s",
                $this->content->getUuid(),
                $slotUuid)
        );
    }

    /**
     * @inheritdoc
     */
    public function getModelClass()
    {
        return Slot::class;
    }
}