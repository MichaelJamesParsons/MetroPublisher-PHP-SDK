<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\MetroPublisher;

/**
 * Class EmbedSlotMedia
 * @package MetroPublisher\Api\Models
 */
class EmbedSlotMedia extends SlotMedia
{
    /**
     * Embed code obtained from a third party service.
     *
     * @var string
     */
    protected $embed_code;

    /**
     * EmbedSlotMedia constructor.
     *
     * @param MetroPublisher $metroPublisher
     * @param Slot           $slot
     */
    public function __construct(MetroPublisher $metroPublisher, Slot $slot)
    {
        parent::__construct($metroPublisher, $slot);
        $this->type = SlotMedia::TYPE_EMBED_CODE;
    }

    /**
     * @return string
     */
    public function getEmbedCode()
    {
        return $this->embed_code;
    }

    /**
     * @param string $embed_code
     *
     * @return $this
     */
    public function setEmbedCode($embed_code)
    {
        $this->embed_code = $embed_code;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public static function getMetaFields()
    {
        return array_merge(['embed_code'], parent::getMetaFields());
    }
}