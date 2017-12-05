<?php

namespace MetroPublisher\Api\Models;

use MetroPublisher\MetroPublisher;

/**
 * Class Article
 * @package MetroPublisher\Api\Models
 */
class Article extends Content
{
    /**
     * Article constructor.
     *
     * @param MetroPublisher $metroPublisher
     * @param string         $uuid
     */
    public function __construct(MetroPublisher $metroPublisher, $uuid)
    {
        parent::__construct($metroPublisher, $uuid);
        $this->content_type = Content::CONTENT_TYPE_ARTICLE;
    }
}