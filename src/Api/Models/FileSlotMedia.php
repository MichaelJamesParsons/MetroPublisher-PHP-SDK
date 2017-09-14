<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\MetroPublisher;

/**
 * Class FileSlotMedia
 * @package MetroPublisher\Api\Models
 *
 * @property string $image_uuid - The UUID of an already uploaded image. Required if file_uuid is empty.
 * @property string $file_uuid  - The UUID of an already uploaded file. Required if image_uuid is empty.
 */
class FileSlotMedia extends SlotMedia
{
    /**
     * FileSlotMedia constructor.
     *
     * @param MetroPublisher $metroPublisher
     * @param Slot $slot
     */
    public function __construct(MetroPublisher $metroPublisher, Slot $slot)
    {
        parent::__construct($metroPublisher, $slot);
        $this->type = SlotMedia::TYPE_FILE;
    }

    /**
     * @inheritdoc
     */
    public static function getMetaFields()
    {
        return array_merge([
            'file_uuid',
            'image_uuid'
        ], parent::getMetaFields());
    }
}