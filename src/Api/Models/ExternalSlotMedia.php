<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\MetroPublisher;

/**
 * Class ExternalSlotMedia
 * @package MetroPublisher\Api\Models
 */
class ExternalSlotMedia extends SlotMedia
{
    /**
     * The type of the external asset.
     *
     * Identifies the external media as a specific type of embed (e.g. YouTube),
     * or file (audio/video file).
     *
     * @see \MetroPublisher\Api\Models\FileMedia   To embed images.
     *
     * @var string
     */
    protected $url_type;

    /**
     * A url to the external media.
     *
     * Required if the url_type is 'vimeo', 'youtube', or 'soundcloud'.
     *
     * @var string
     */
    protected $url;

    /**
     * A list of URLs.
     *
     * Required if the url_type is 'audio' or 'video'. Every element of
     * the list is a dictionary, each consisting of the following fields:
     *      - url
     *      - mimetype (optional)
     *
     * @var array
     */
    protected $urls;

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

    public function __construct(MetroPublisher $metroPublisher)
    {
        parent::__construct($metroPublisher);
        $this->type = SlotMedia::TYPE_EXTERNAL_URL;
    }

    /**
     * @return string
     */
    public function getUrlType()
    {
        return $this->url_type;
    }

    /**
     * @param string $url_type
     *
     * @return $this
     */
    public function setUrlType($url_type)
    {
        $this->url_type = $url_type;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return array
     */
    public function getUrls()
    {
        return $this->urls;
    }

    /**
     * @param array $urls
     *
     * @return $this
     */
    public function setUrls($urls)
    {
        $this->urls = $urls;

        return $this;
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