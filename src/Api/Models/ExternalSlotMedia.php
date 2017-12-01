<?php

namespace MetroPublisher\Api\Models;

use MetroPublisher\MetroPublisher;

/**
 * Class ExternalSlotMedia
 * @package MetroPublisher\Api\Models
 *
 * @property string $url_type - The type of the external asset. Identifies the external media as a specific type
 *                              of embed (e.g. YouTube), or file (audio/video file).
 * @property string $url      - A url to the external media. Required if the url_type is 'vimeo', 'youtube',
 *                              or 'soundcloud'.
 * @property array  $urls     - A list of URLs. Required if the url_type is 'audio' or 'video'. Every element of the
 *                              list is a dictionary, each consisting of the following fields:
 *                                  'url', 'mimetype' (optional)
 */
class ExternalSlotMedia extends SlotMedia
{
    /**
     * This external media is an audio file. (.mp3, .ogg, .wav, etc.)
     */
    const URL_TYPE_AUDIO = 'audio';

    /**
     * This external media links to a SoundCloud embed.
     */
    const URL_TYPE_SOUNDCLOUD = 'soundcloud';

    /**
     * This external media is a video file (.mp4, webm, .ogg, etc.)
     */
    const URL_TYPE_VIDEO = 'video';

    /**
     * This external media links to a Vimeo embed.
     */
    const URL_TYPE_VIMEO = 'vimeo';

    /**
     * This external media links to a YouTube embed.
     */
    const URL_TYPE_YOUTUBE = 'youtube';

    public function __construct(MetroPublisher $metroPublisher, Slot $slot)
    {
        parent::__construct($metroPublisher, $slot);
        $this->type = SlotMedia::TYPE_EXTERNAL_URL;
    }

    /**
     * @inheritdoc
     */
    public static function getMetaFields()
    {
        return array_merge([
            'url_type',
            'url',
            'urls'
        ], parent::getMetaFields());
    }
}