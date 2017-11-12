<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\AbstractResourceModel;
use MetroPublisher\Exception\MetroPublisherException;

/**
 * Class Section
 * @package MetroPublisher\Api\Models
 */
class Section extends AbstractResourceModel
{
    /** @var  string */
    protected $title;

    /** @var  string */
    protected $urlname;

    /** @var  string */
    protected $parent_uuid;

    /** @var  boolean */
    protected $auto_featured_stories;

    /** @var  int */
    protected $auto_featured_stories_num;

    /** @var  string */
    protected $externalurl;

    /** @var  string */
    protected $feature_image_url;

    /** @var  boolean */
    protected $hide_in_nav;

    /** @var  string */
    protected $lead_story_url;

    /** @var  string */
    protected $meta_description;

    /** @var  string */
    protected $meta_keywords;

    /** @var  int */
    protected $ord;

    /** @var  boolean */
    protected $show_prev_next;

    /**
     * @inheritdoc
     */
    public static function getDefaultFields()
    {
        return array_merge([
            'title',
            'urlname',
            'parent_uuid',
            'auto_featured_stories',
            'auto_featured_stories_num',
            'externalurl',
            'feature_image_url',
            'hide_in_nav',
            'lead_story_url',
            'meta_description',
            'meta_keywords',
            'ord',
            'show_prev_next'
        ],
        parent::getDefaultFields());
    }

    /**
     * @inheritdoc
     */
    public function save() {
        return $this->doSave("/sections/{$this->uuid}");
    }

    /**
     * @inheritdoc
     * @deprecated
     */
    public function delete() {
        // @todo - Find more elegant solution
        throw new MetroPublisherException("Sections cannot be deleted.");
    }

    /**
     * @return array
     */
    protected function loadMetaData()
    {
        // @todo handle this
        return null;
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
    public function getUrlname()
    {
        return $this->urlname;
    }

    /**
     * @param string $urlname
     * @return $this
     */
    public function setUrlname($urlname)
    {
        $this->urlname = $urlname;

        return $this;
    }

    /**
     * @return string
     */
    public function getParentUuid()
    {
        return $this->parent_uuid;
    }

    /**
     * @param string $parent_uuid
     * @return $this
     */
    public function setParentUuid($parent_uuid)
    {
        $this->parent_uuid = $parent_uuid;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAutoFeaturedStories()
    {
        return $this->auto_featured_stories;
    }

    /**
     * @param bool $auto_featured_stories
     * @return $this
     */
    public function setAutoFeaturedStories($auto_featured_stories)
    {
        $this->auto_featured_stories = $auto_featured_stories;

        return $this;
    }

    /**
     * @return int
     */
    public function getAutoFeaturedStoriesNum()
    {
        return $this->auto_featured_stories_num;
    }

    /**
     * @param int $auto_featured_stories_num
     * @return $this
     */
    public function setAutoFeaturedStoriesNum($auto_featured_stories_num)
    {
        $this->auto_featured_stories_num = $auto_featured_stories_num;

        return $this;
    }

    /**
     * @return string
     */
    public function getExternalurl()
    {
        return $this->externalurl;
    }

    /**
     * @param string $externalurl
     * @return $this
     */
    public function setExternalurl($externalurl)
    {
        $this->externalurl = $externalurl;

        return $this;
    }

    /**
     * @return string
     */
    public function getFeatureImageUrl()
    {
        return $this->feature_image_url;
    }

    /**
     * @param string $feature_image_url
     * @return $this
     */
    public function setFeatureImageUrl($feature_image_url)
    {
        $this->feature_image_url = $feature_image_url;

        return $this;
    }

    /**
     * @return bool
     */
    public function isHideInNav()
    {
        return $this->hide_in_nav;
    }

    /**
     * @param bool $hide_in_nav
     * @return $this
     */
    public function setHideInNav($hide_in_nav)
    {
        $this->hide_in_nav = $hide_in_nav;

        return $this;
    }

    /**
     * @return string
     */
    public function getLeadStoryUrl()
    {
        return $this->lead_story_url;
    }

    /**
     * @param string $lead_story_url
     * @return $this
     */
    public function setLeadStoryUrl($lead_story_url)
    {
        $this->lead_story_url = $lead_story_url;

        return $this;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    /**
     * @param string $meta_description
     * @return $this
     */
    public function setMetaDescription($meta_description)
    {
        $this->meta_description = $meta_description;

        return $this;
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->meta_keywords;
    }

    /**
     * @param string $meta_keywords
     * @return $this
     */
    public function setMetaKeywords($meta_keywords)
    {
        $this->meta_keywords = $meta_keywords;

        return $this;
    }

    /**
     * @return int
     */
    public function getOrd()
    {
        return $this->ord;
    }

    /**
     * @param int $ord
     * @return $this
     */
    public function setOrd($ord)
    {
        $this->ord = $ord;

        return $this;
    }

    /**
     * @return bool
     */
    public function isShowPrevNext()
    {
        return $this->show_prev_next;
    }

    /**
     * @param bool $show_prev_next
     * @return $this
     */
    public function setShowPrevNext($show_prev_next)
    {
        $this->show_prev_next = $show_prev_next;

        return $this;
    }
}