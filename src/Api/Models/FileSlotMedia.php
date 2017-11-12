<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\MetroPublisher;

/**
 * Class FileSlotMedia
 * @package MetroPublisher\Api\Models
 */
class FileSlotMedia extends SlotMedia
{
    /**
     * @var string The UUID of an already uploaded image. Required if file_uuid is empty.
     */
    protected $image_uuid;

    /**
     * @var string The UUID of an already uploaded file. Required if image_uuid is empty.
     */
    protected $file_uuid;

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

    public static function getDefaultFields()
    {
        return [
            'uuid',
            'title',
            'type',
            'content',
            'thumb_uuid',
            'slot_uuid',
            'content_uuid',
            'image_uuid',
            'file_uuid'
        ];
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

    /**
     * @return string
     */
    public function getImageUuid()
    {
        return $this->image_uuid;
    }

    /**
     * @param string $image_uuid
     * @return $this
     */
    public function setImageUuid($image_uuid)
    {
        $this->image_uuid = $image_uuid;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getFileUuid()
    {
        return $this->file_uuid;
    }

    /**
     * @param string $file_uuid
     * @return $this
     */
    public function setFileUuid($file_uuid)
    {
        $this->file_uuid = $file_uuid;
    
        return $this;
    }
}