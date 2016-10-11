<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\AbstractResourceCollection;
use MetroPublisher\Api\Content;
use MetroPublisher\Api\Models\Slot;
use MetroPublisher\MetroPublisher;

/**
 * Class SlotCollection
 * @package MetroPublisher\Api\Collections
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

    /**
     * @inheritdoc
     */
    protected function getModelClass()
    {
        return Slot::class;
    }
}