<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\Content;
use MetroPublisher\MetroPublisher;

/**
 * Class Article
 * @package MetroPublisher\Api\Models
 *
 * @property string $blog_uuid
 * @property string $section_uuid
 */
class Article extends Content
{
    public function __construct(MetroPublisher $metroPublisher, array $properties)
    {
        parent::__construct($metroPublisher, $properties);
        $this->properties['contentType'] = Content::CONTENT_TYPE_ARTICLE;
    }

    public static function getFieldNames()
    {
        return array_merge(['blog_uuid', 'section_uuid'], parent::getFieldNames());
    }
}