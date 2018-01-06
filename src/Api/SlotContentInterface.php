<?php
namespace MetroPublisher\Api;

/**
 * Interface SlotContentInterface
 * @package MetroPublisher\Api
 */
interface SlotContentInterface
{
    /**
     * Get the settings of a content object's slots.
     *
     * @link https://api.metropublisher.com/resources/content.html#content_slots
     *
     * @return AbstractModel[]|Slot[]
     */
    public function getSlots();

    /**
     * Returns content's uuid.
     *
     * @return string
     */
    public function getUuid();
}