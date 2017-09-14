<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\AbstractResourceModel;
use MetroPublisher\MetroPublisher;

/**
 * Class SlotMedia
 * @package MetroPublisher\Api\Models
 */
abstract class SlotMedia extends AbstractResourceModel
{
    /**
     * The type of media.
     *
     * Describes the source of the media. Whether it be an
     * external embed or file (image, audio file, video file).
     *
     * @var string
     */
    protected $type;

    /** @var string */
    protected $title;

    /**
     * HTML content describing the media.
     *
     * The content is validated through a strict schema. For more
     * information, view the link below.
     *
     * @link https://api.metropublisher.com/mp_rng.html
     *
     * @var string
     */
    protected $content;

    /**
     * The UUID of an image thumbnail.
     *
     * The thumbnail must have already been uploaded before attaching
     * it to this property.
     *
     * @var string
     */
    protected $thumb_uuid;

    /** @var  string */
    protected $slot_uuid;

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
     */
    public function __construct(MetroPublisher $metroPublisher, Slot $slot)
    {
        parent::__construct($metroPublisher);
        $this->slot_uuid = $slot->getUuid();
        $this->content_uuid = $slot->getContentUuid();
    }

    /**
     * @inheritdoc
     */
    public function save($endpoint)
    {
        return parent::doSave("/content/{$this->slot_uuid}/slots/{}/media");
    }

    /**
     * @inheritdoc
     */
    public function delete($endpoint)
    {
        return parent::delete($endpoint);
    }

    /**
     * @inheritdoc
     */
    public static function getDefaultFields()
    {
        return array_merge([
            'type',
            'title',
            'thumb_uuid'
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
        return $this->client->get("/content/{$this->content_uuid}/slots/{$this->uuid}");
    }
}