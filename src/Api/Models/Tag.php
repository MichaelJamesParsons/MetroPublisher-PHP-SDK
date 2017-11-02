<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\AbstractResourceModel;
use MetroPublisher\Api\Models\Exception\ModelValidationException;
use MetroPublisher\Api\Models\Resolvers\ModelResolver;
use MetroPublisher\Common\Serializers\ModelDeserializer;

/**
 * Class Tag
 * @package MetroPublisher\Api\Models
 */
class Tag extends AbstractResourceModel
{
    /** @var  string */
    protected $last_name_or_title;

    /** @var  string */
    protected $first_name;

    /** @var  string */
    protected $description;

    /** @var  string */
    protected $state;

    /** @var  string */
    protected $synonyms;

    /** @var  string */
    protected $content;

    /** @var  string */
    protected $feature_image_uuid;

    /** @var  string */
    protected $type;

    /** @var  string */
    protected $urlname;

    /**
     * A non-person tag.
     *
     * Tag does not have a first_name. An exception will be
     * thrown if the type is set to default, and the first_name
     * field has a value.
     */
    const TYPE_DEFAULT = 'default';

    /**
     * A person tag. May have a first_name.
     *
     * The first_name field is optional, even if the tag is of
     * this type.
     */
    const TYPE_PERSON = 'person';

    /**
     * This tag is approved and will appear on the public site.
     */
    const STATE_APPROVED    = 'approved';

    /**
     * This tag is an internal tag and will not be visible on the
     * public site.
     */
    const STATE_INTERNAL    = 'internal';

    /**
     * This tag is provisional and pending approval. It will not be
     * visible on the public site.
     */
    const STATE_PROVISIONAL = 'provisional';

    /**
     * The tag is the author of the content object.
     *
     * Used for articles, reviews, roundups, and events.
     */
    const PREDICATE_AUTHORED = 'authored';

    /**
     * The tag is describes something within the content object.
     *
     * Used for articles, reviews, roundups, events, and files.
     */
    const PREDICATE_DESCRIBES = 'describes';

    /**
     * The tag represents the editor of the content object.
     *
     * Used for articles, reviews, roundups, and events.
     */
    const PREDICATE_EDITED = 'edited';

    /**
     * The tag is the brand of the object being reviewed,
     * e.g. the company producing a product.
     *
     * Used for albums, books, and products.
     */
    const PREDICATE_BRAND_OF_REVIEWED = 'is_brand_of_reviewed';

    /**
     * The tag is the type of the object being reviewed,
     * e.g. the genre of a book.
     *
     * Used for albums, books, and products.
     */
    const PREDICATE_TYPE_OF_REVIEWED = 'type_of_reviewed';

    /**
     * The tag is the creator of the object being reviewed,
     * e.g. the publisher of a book.
     *
     * Used for reviews of albums and books.
     */
    const PREDICATE_CREATED_REVIEWED = 'created_reviewed';

    /**
     * The tag is the illustrator of the object being reviewed,
     * e.g. the illustrator of a book.
     *
     * Used for books.
     */
    const PREDICATE_ILLUSTRATED_REVIEWED = 'illustrated_reviewed';

    /**
     * The tag is the translator of the object being reviewed,
     * e.g. the translator of a book.
     *
     * Used for books.
     */
    const PREDICATE_TRANSLATED_REVIEWED = 'translated_reviewed';

    /**
     * The tag is the photographer of an image.
     *
     * Used for files.
     */
    const PREDICATE_PHOTOGRAPHED = 'photographed';

    /**
     * The tag is the illustrator of an image,
     * e.g. if the image depicts a comic strip.
     *
     * Used for files.
     */
    const PREDICATE_ILLUSTRATED = 'illustrated';

    /**
     * @inheritdoc
     */
    public function save()
    {
        return $this->doSave("/tags/{$this->uuid}");
    }

    /**
     * @inheritdoc
     */
    public function delete()
    {
        return $this->doDelete("/tags/{$this->uuid}");
    }

    /**
     * Retrieve a batched collection of the categories of a specific tag.
     *
     * @link https://api.metropublisher.com/resources/tag.html#resource-get-tag-cats
     *
     * @return TagCategory[]
     */
    public function getCategories() {
        $response = $this->context->get("/tags/{$this->uuid}/categories");

        /** @var TagCategory[] $categories */
        $categories = ModelDeserializer::convertCollection(
            new ModelResolver(TagCategory::class),
            $response
        );

        return $categories;
    }

    /**
     * Gets the path history for this content.
     *
     * @link https://api.metropublisher.com/resources/content.html#content_path_history
     * @return array
     * @throws ModelValidationException
     */
    public function getPathHistory() {
        if (empty($this->uuid)) {
            throw new ModelValidationException('Tag must have a UUID set to get path history.');
        }

        $response = $this->context->get("/tags/{$this->uuid}/path_history");
        return ModelDeserializer::convertCollection(new ModelResolver($response), $response, [$this->context]);
    }

    /**
     * Sets the path history for this tag.
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
     * @see Tag::addPathHistory()   To add a single path_history entry.
     *
     * @param array $pathHistories A list of PathHistory objects.
     *
     * @return array
     * @throws ModelValidationException
     */
    public function setPathHistory(array $pathHistories) {
        if (empty($this->uuid)) {
            throw new ModelValidationException('Tag must have a UUID set to set path history.');
        }

        $response = $this->context->put("/tags/{$this->uuid}/path_history",
            [ 'items' => $pathHistories ]
        );

        return ModelDeserializer::convertCollection(new ModelResolver(PathHistory::class), $response, [$this->context]);
    }

    /**
     * Adds a path history entry for this tag.
     *
     * @see Tag::setPathHistory()   To add many entries at once.
     *
     * @param PathHistory $pathHistory
     *
     * @return array
     * @throws ModelValidationException
     */
    public function addPathHistory(PathHistory $pathHistory) {
        if (empty($this->uuid)) {
            throw new ModelValidationException('Tag must have a UUID set to add path history.');
        }

        return $this->context->post("/tags/{$this->uuid}/path_history",
            [ 'path' => $pathHistory->getPath() ]
        );
    }

    /**
     * @inheritdoc
     */
    public static function getDefaultFields()
    {
        return array_merge([
            'last_name_or_title',
            'first_name',
            'description',
            'state',
            'synonyms',
            'content',
            'urlname',
            'feature_image_uuid'
        ], parent::getDefaultFields());
    }

    /**
     * @inheritdoc
     */
    protected function loadMetaData()
    {
        return $this->context->get(
            sprintf('/tags/%s', $this->uuid)
        );
    }

    /**
     * @return string
     */
    public function getLastNameOrTitle()
    {
        return $this->last_name_or_title;
    }

    /**
     * @param string $last_name_or_title
     *
     * @return $this
     */
    public function setLastNameOrTitle($last_name_or_title)
    {
        $this->last_name_or_title = $last_name_or_title;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     *
     * @return $this
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;

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
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     *
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
    public function getSynonyms()
    {
        return $this->synonyms;
    }

    /**
     * @param string $synonyms
     *
     * @return $this
     */
    public function setSynonyms($synonyms)
    {
        $this->synonyms = $synonyms;

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
     *
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
    public function getFeatureImageUuid()
    {
        return $this->feature_image_uuid;
    }

    /**
     * @param string $feature_image_uuid
     *
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

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
}