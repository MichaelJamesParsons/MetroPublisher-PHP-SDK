<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\Collections\ArticleCollection;
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
     */
    public function __construct(MetroPublisher $metroPublisher)
    {
        parent::__construct($metroPublisher, new ArticleCollection($metroPublisher));
        $this->properties['contentType'] = Content::CONTENT_TYPE_ARTICLE;
    }
}