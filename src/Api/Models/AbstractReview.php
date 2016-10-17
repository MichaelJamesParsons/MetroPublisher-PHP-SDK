<?php
namespace MetroPublisher\Api\Models;

/**
 * Class AbstractReview
 * @package MetroPublisher\Api\Models
 *
 * @property string $rating
 */
class AbstractReview extends Content
{
    /**
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param string $rating
     *
     * @return $this
     */
    public function setRating($rating)
    {
        //Convert float to string to prevent API errors.
        $this->rating = $rating . "";

        return $this;
    }

    /**
     * @inheritdoc
     */
    public static function getMetaFields()
    {
        return array_merge([
            'rating'
        ], parent::getMetaFields());
    }
}