<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\AbstractResourceCollection;
use MetroPublisher\Api\Models\Content;
use MetroPublisher\Api\Models\Slot;
use MetroPublisher\MetroPublisher;

/**
 * Class SlotCollection
 * @package MetroPublisher\Api\Collections
 */
class SlotCollection extends Abstr actResourceCollection
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
        return parent::all(sprintf('%s/content/%s/slots', $this->getBaseUri(), $this->content->getUuid()));
    }

    public function find(Slot $slot) {
        return parent::find(
            sprintf('%s/content/%s/slots/%s',
                $this->getBaseUri(),
                $this->content->getUuid(),
                $slot->getUuid())
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