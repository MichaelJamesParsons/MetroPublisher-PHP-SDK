<?php
namespace MetroPublisher\Api\Models;

/**
 * Class AbstractReview
 * @package MetroPublisher\Api\Models
 *
 * @property string $rating
 */
abstract class AbstractReview extends Content
{
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

    /**
     * @inheritdoc
     */
    public static function getMetaFields()
    {
        return array_merge(['rating'], parent::getMetaFields());
    }
}