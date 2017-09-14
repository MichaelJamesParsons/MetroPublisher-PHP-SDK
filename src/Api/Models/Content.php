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
 *
 * @property string     $content_type
 * @property string     $title
 * @property string     $description
 * @property string     $content
 * @property string     $state
 * @property string     $meta_title
 * @property string     $meta_description
 * @property string     $print_description
 * @property DateTime   $issued
 * @property string     $urlname
 * @property boolean    $evergreen
 * @property string     $teaser_image_uuid
 * @property string     $feature_image_uuid
 */
abstract class Content extends AbstractResourceModel implements TaggableInterface
{
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
        return parent::doSave("/content/{$this->uuid}");
    }

    /**
     * @inheritdoc
     */
    public function delete() {
        return parent::doDelete("/content/{$this->uuid}");
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
        return $this->client->get(
            sprintf('%s/content/%s/related_links', $this->getBaseUri(), $this->uuid),
            ['state' => $state]
        );
    }

    /**
     * @inheritdoc
     *
     * @link https://api.metropublisher.com/resources/content.html#content_tags
     */
    public function getTags($state = 'approved') {
        $tags = $this->client->get(
            sprintf('%s/content/%s/tags', $this->getBaseUri(), $this->uuid),
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
        $tags = $this->client->get(
            sprintf('%s/content/%s/tags/%s', $this->getBaseUri(), $this->uuid, $predicate),
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
        $response = $this->client->get(sprintf('%s/content/%s/slots', $this->getBaseUri(), $this->uuid));
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
        $response = $this->client->get(
            sprintf('%s/content/%s/path_history', $this->getBaseUri(), $this->uuid)
        );

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
        $response = $this->client->put(
            sprintf('%s/content/%s/path_history', $this->getBaseUri(), $this->uuid),
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
        return $this->client->post(
            sprintf('%s/content/%s/path_history', $this->getBaseUri(), $this->uuid),
            [ 'path' => $pathHistory->getPath() ]
        );
    }

    /**
     * @inheritdoc
     */
    protected function loadMetaData()
    {
        return $this->client->get(sprintf('%s/content/%s', $this->getBaseUri(), $this->uuid));
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
     * @inheritdoc
     */
    public static function getDefaultFields() {
        return array_merge([
            'content_type',
            'title',
            'description',
            'state',
            'issued',
        ], parent::getDefaultFields());
    }
}