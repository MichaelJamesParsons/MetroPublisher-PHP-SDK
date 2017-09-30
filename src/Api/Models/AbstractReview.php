<?php
namespace MetroPublisher\Api\Models;

/**
 * Class AbstractReview
 * @package MetroPublisher\Api\Models
 */
abstract class AbstractReview extends Content
{
    /** @var  string */
    protected $rating;

    /**
     * @inheritdoc
     */
    public static function getMetaFields()
    {
        return array_merge(['rating'], parent::getMetaFields());
    }

    /**
     * @return float
     */
    public function getRating() {
        return floatval($this->rating);
    }

    /**
     * @param int $rating
     *
     * @return $this
     */
    public function setRating($rating)
    {
        //Convert float to string to prevent API errors.
        $this->rating = $rating . "";

        return $this;
    }
}