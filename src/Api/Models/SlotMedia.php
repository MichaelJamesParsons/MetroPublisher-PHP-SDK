<?php

namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\AbstractResourceModel;
use MetroPublisher\Api\DeletableResourceModelTrait;
use MetroPublisher\Api\Models\Exception\ModelValidationException;
use MetroPublisher\MetroPublisher;

/**
 * Class SlotMedia
 * @package MetroPublisher\Api\Models
 */
abstract class SlotMedia extends AbstractResourceModel
{
    use DeletableResourceModelTrait;

    /**
     * The type of media. Describes the source of the media. Whether it be an
     * external embed or file (image, audio file, video file).
     *
     * @var  string
     */
    protected $type;

    /** @var  string */
    protected $title;

    /**
     * HTML content describing the media. The content is validated through a strict schema.
     *
     * @var  string
     */
    protected $content;

    /** @var  string */
    protected $thumb_uuid;

    /** @var string */
    protected $slot_uuid;

    /** @var string */
    protected $content_uuid;

    /**
     * The media is an embed code from another site.
     */
    const TYPE_EMBED_CODE = 'embed';

    /**
     * The media is a link to an external service, such as
     * Youtube, Vimeo, or SoundCloud.
     */
    const TYPE_EXTERNAL_URL = 'external';

    /**
     * The media is an image, audio, or video file.
     *
     * This assumes the file has already been uploaded
     * to the API and has its own UUID.
     */
    const TYPE_FILE = 'file';

    /**
     * SlotMedia constructor.
     *
     * @param MetroPublisher $metroPublisher
     * @param Slot           $slot
     * @param int            $uuid
     */
    public function __construct(MetroPublisher $metroPublisher, Slot $slot, $uuid)
    {
        parent::__construct($metroPublisher, $uuid);
        $this->slot_uuid    = $slot->getUuid();
        $this->content_uuid = $slot->getContentUuid();
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        if (empty($this->slot_uuid)) {
            throw new ModelValidationException('Slot Media cannot be saved without an associated slot UUID.');
        }

        if (empty($this->content_uuid)) {
            throw new ModelValidationException('Slot Media cannot be saved without an associated content UUID.');
        }

        return $this->doSave("/content/{$this->content_uuid}/slots/{$this->slot_uuid}/media");
    }

    /**
     * @inheritdoc
     */
    public function delete()
    {
        if (empty($this->slot_uuid)) {
            throw new ModelValidationException('Slot Media cannot be deleted without an associated slot UUID.');
        }

        if (empty($this->content_uuid)) {
            throw new ModelValidationException('Slot Media cannot be deleted without an associated content UUID.');
        }

        return $this->doDelete("/content/{$this->content_uuid}/slots/{$this->slot_uuid}/media");
    }

    /**
     * @inheritdoc
     */
    public static function getDefaultFields()
    {
        return array_merge([
            'type',
            'title',
            'thumb_uuid',
            'slot_uuid',
            'content_uuid'
        ], parent::getDefaultFields());
    }

    /**
     * @inheritdoc
     */
    public static function getMetaFields()
    {
        return array_merge(['content'], parent::getMetaFields());
    }

    /**
     * @inheritdoc
     */
    public function loadMetaData()
    {
        return $this->context->get("/content/{$this->content_uuid}/slots/{$this->uuid}");
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getThumbUuid()
    {
        return $this->thumb_uuid;
    }

    /**
     * @param string $thumb_uuid
     *
     * @return $this
     */
    public function setThumbUuid($thumb_uuid)
    {
        $this->thumb_uuid = $thumb_uuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlotUuid()
    {
        return $this->slot_uuid;
    }

    /**
     * @param string $slot_uuid
     *
     * @return $this
     */
    public function setSlotUuid($slot_uuid)
    {
        $this->slot_uuid = $slot_uuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getContentUuid()
    {
        return $this->content_uuid;
    }

    /**
     * @param string $content_uuid
     *
     * @return $this
     */
    public function setContentUuid($content_uuid)
    {
        $this->content_uuid = $content_uuid;

        return $this;
    }
}