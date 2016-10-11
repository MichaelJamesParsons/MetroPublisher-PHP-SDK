<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\AbstractResourceModel;

/**
 * Class Tag
 * @package MetroPublisher\Api\Models
 *
 * @property string $last_name_or_title
 * @property string $first_name
 * @property string $description
 * @property string $state
 * @property array  $synonyms
 *                  - @todo add field getters/setters.
 *                  - @todo convert to string before save.
 *                  - @todo convert to array when value is set from API
 * @property string $content
 * @property string $feature_image_uuid
 *
 */
class Tag extends AbstractResourceModel
{
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
    public function getFieldNames()
    {
        return array_merge([
            'last_name_or_title',
            'first_name',
            'description',
            'state',
            'synonyms',
            'content',
            'feature_image_uuid'
        ], parent::getFieldNames());
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
     * @return array
     */
    public function getSynonyms()
    {
        return $this->synonyms;
    }

    /**
     * @param array $synonyms
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
}