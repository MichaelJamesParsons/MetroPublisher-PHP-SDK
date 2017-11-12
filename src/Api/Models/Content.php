<?php
namespace MetroPublisher\Api\Models;

use DateTime;
use MetroPublisher\Api\AbstractResourceModel;
use MetroPublisher\Api\Collections\SlotCollection;
use MetroPublisher\Api\Collections\TagCollection;
use MetroPublisher\Api\Models\Resolvers\ModelResolver;
use MetroPublisher\Api\TaggableInterface;
use MetroPublisher\Common\Serializers\ModelDeserializer;
use MetroPublisher\MetroPublisher;

/**
 * Class Content
 * @package MetroPublisher\Api\Content
 */
class Content extends AbstractResourceModel implements TaggableInterface
{
    /** @var  string */
    protected $content_type;

    /** @var  string */
    protected $title;

    /** @var  string */
    protected $description;

    /** @var  string */
    protected $content;

    /** @var  string */
    protected $state;

    /** @var  string */
    protected $meta_title;

    /** @var  string */
    protected $meta_description;

    /** @var  string */
    protected $print_description;

    /** @var  DateTime */
    protected $issued;

    /** @var  string */
    protected $urlname;

    /** @var  boolean */
    protected $evergreen;

    /** @var  string */
    protected $teaser_image_uuid;

    /** @var  string */
    protected $feature_image_uuid;

    /** @var  string */
    protected $section_uuid;

    /** @var  SlotCollection */
    protected $slotCollection;

    /** @var  TagCollection */
    protected $tagCollection;

    const CONTENT_TYPE_ARTICLE = 'article';
    const CONTENT_TYPE_EVENT   = 'event';
    const CONTENT_TYPE_REVIEW  = 'review'; //Same as review_location
    const CONTENT_TYPE_REVIEW_ALBUM = 'review_album';
    const CONTENT_TYPE_REVIEW_BOOK  = 'review_book';
    const CONTENT_TYPE_REVIEW_PRODUCT = 'review_product';
    const CONTENT_TYPE_REVIEW_LOCATION  = 'review_location';
    const CONTENT_TYPE_ROUNDUP_LOCATION = 'roundup_location';

    const STATE_LIVE      = 'live';
    const STATE_DRAFT     = 'draft';
    const STATE_PUBLISHED = 'published';

    /**
     * Content constructor.
     *
     * @param MetroPublisher $metroPublisher
     */
    public function __construct(MetroPublisher $metroPublisher)
    {
        parent::__construct($metroPublisher);

        $this->slotCollection = new SlotCollection($metroPublisher, $this);
        $this->tagCollection = new TagCollection($metroPublisher);
    }

    /**
     * @inheritdoc
     */
    public function save() {
        return $this->doSave("/content/{$this->uuid}");
    }

    /**
     * @inheritdoc
     */
    public function delete() {
        return $this->doDelete("/content/{$this->uuid}");
    }

    /**
     * Get the links related to a content object.
     *
     * The related links may be filtered by specifying a state, whether
     * it be live, draft, or published. The state 'live' is used by default
     * if the user is public. Otherwise, no state filter will be applied.
     *
     * @link https://api.metropublisher.com/resources/content.html#content_related_links
     *
     * @param string $state The state of which the related links must have to
     *                      be included in the results.
     *
     * @return array
     */
    public function getRelatedLinks($state = 'published') {
        return $this->context->get("/content/{$this->uuid}/related_links",
            ['state' => $state]
        );
    }

    /**
     * @inheritdoc
     *
     * @link https://api.metropublisher.com/resources/content.html#content_tags
     */
    public function getTags($state = 'approved') {
        $tags = $this->context->get("/content/{$this->uuid}/tags",
            ['state' => $state]
        );

        return ModelDeserializer::convertCollection(new ModelResolver(Tag::class), $tags['items'], [$this->context]);
    }

    /**
     * @inheritdoc
     *
     * @link https://api.metropublisher.com/resources/content.html#content_tags_all
     */
    public function getTagsWithPredicate($predicate, $state = 'approved') {
        $tags = $this->context->get("/content/{$this->uuid}/tags/{$predicate}",
            ['state' => $state]
        );

        return ModelDeserializer::convertCollection(new ModelResolver(Tag::class), $tags['items'], [$this->context]);
    }

    /**
     * Get the settings of a content object's slots.
     *
     * @link https://api.metropublisher.com/resources/content.html#content_slots
     *
     * @return AbstractModel[]|Slot[]
     */
    public function getSlots() {
        $response = $this->context->get("/content/{$this->uuid}/slots");
        return ModelDeserializer::convertCollection(new ModelResolver(Slot::class), $response['items'], [$this->context]);
    }

    /**
     * Gets the path history for this content.
     *
     * @link https://api.metropublisher.com/resources/content.html#content_path_history
     *
     * @return array
     */
    public function getPathHistory() {
        $response = $this->context->get("/content/{$this->uuid}/path_history");
        return ModelDeserializer::convertCollection(new ModelResolver(PathHistory::class), $response['items'], [$this->context]);
    }

    /**
     * Sets the path history for this content.
     *
     * This method will replace all path_history entries for this
     * content item with the list of path history items. To remove
     * all path history items, call this method with an empty array
     * as the first parameter.
     *
     * To add many entries at once, fetch this content's path history
     * entries, then merge your own entries with the results and pass
     * the collection into this method.
     *
     * @see Content::addPathHistory()   To add a single path_history entry.
     * @link https://api.metropublisher.com/resources/content.html#content_path_history_put
     *
     * @param array $pathHistories A list of PathHistory objects.
     *
     * @return array
     */
    public function setPathHistory(array $pathHistories) {
        $response = $this->context->put("/content/{$this->uuid}/path_history",
            [ 'items' => $pathHistories ]
        );

        return ModelDeserializer::convertCollection(new ModelResolver(PathHistory::class), $response, [$this->context]);
    }

    /**
     * Adds a path history entry for this content.
     *
     * @see Content::setPathHistory()   To add many entries at once.
     * @link https://api.metropublisher.com/resources/content.html#content_path_history_post
     *
     * @param PathHistory $pathHistory
     *
     * @return array
     */
    public function addPathHistory(PathHistory $pathHistory) {
        return $this->context->post("/content/{$this->uuid}/path_history",
            [ 'path' => $pathHistory->getPath() ]
        );
    }

    /**
     * @inheritdoc
     */
    protected function loadMetaData()
    {
        return $this->context->get("/content/{$this->uuid}");
    }

    /**
     * @inheritdoc
     */
    public static function getDefaultFields() {
        return array_merge([
            'content_type',
            'title',
            'urlname',
            'description',
            'state',
            'issued',
        ], parent::getDefaultFields());
    }

    /**
     * @inheritdoc
     */
    public static function getMetaFields() {
        return [
            'content',
            'meta_title',
            'meta_description',
            'print_description',
            'evergreen',
            'teaser_image_uuid',
            'feature_image_uuid'
        ];
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->content_type;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->meta_title;
    }

    /**
     * @param string $meta_title
     * @return $this
     */
    public function setMetaTitle($meta_title)
    {
        $this->meta_title = $meta_title;

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
    public function getPrintDescription()
    {
        return $this->print_description;
    }

    /**
     * @param string $print_description
     * @return $this
     */
    public function setPrintDescription($print_description)
    {
        $this->print_description = $print_description;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getIssued()
    {
        return $this->issued;
    }

    /**
     * @param DateTime $issued
     * @return $this
     */
    public function setIssued($issued)
    {
        $this->issued = $issued;

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
     * @return bool
     */
    public function isEvergreen()
    {
        return $this->evergreen;
    }

    /**
     * @param bool $evergreen
     * @return $this
     */
    public function setEvergreen($evergreen)
    {
        $this->evergreen = $evergreen;

        return $this;
    }

    /**
     * @return string
     */
    public function getTeaserImageUuid()
    {
        return $this->teaser_image_uuid;
    }

    /**
     * @param string $teaser_image_uuid
     * @return $this
     */
    public function setTeaserImageUuid($teaser_image_uuid)
    {
        $this->teaser_image_uuid = $teaser_image_uuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getFeatureImageUuid()
    {
        return $this->feature_image_uuid;
    }

    /**
     * @param string $feature_image_uuid
     * @return $this
     */
    public function setFeatureImageUuid($feature_image_uuid)
    {
        $this->feature_image_uuid = $feature_image_uuid;

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
     * @return $this
     */
    public function setSectionUuid($section_uuid)
    {
        $this->section_uuid = $section_uuid;

        return $this;
    }
}