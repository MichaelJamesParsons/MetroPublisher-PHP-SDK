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
    public function __construct(MetroPublisher $metroPublisher)
    {
        parent::__construct($metroPublisher);
        $this->properties['contentType'] = Content::CONTENT_TYPE_ARTICLE;
    }

    public function getFieldNames()
    {
        return array_merge(['blog_uuid', 'section_uuid'], parent::getFieldNames());
    }

    /**
     * @return string
     */
    public function getBlogUuid()
    {
        return $this->blog_uuid;
    }

    /**
     * @param string $blog_uuid
     *
     * @return $this
     */
    public function setBlogUuid($blog_uuid)
    {
        $this->blog_uuid = $blog_uuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getSectionUuid()
    {
        return $this->section_uuid;
    }

    /**
     * @param string $section_uuid
     *
     * @return $this
     */
    public function setSectionUuid($section_uuid)
    {
        $this->section_uuid = $section_uuid;

        return $this;
    }
}