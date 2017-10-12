<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\Exception\MetroPublisherException;
use MetroPublisher\Http\Exception\BadParametersException;

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
     * @throws MetroPublisherException
     */
    public function setRating($rating)
    {
        if ($rating !== 0 && ($rating < 0 || $rating > 5 || $rating % .5 > 0)) {
            throw new MetroPublisherException('Rating must be 0, 0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, or 5. ');
        }

        //API expects value to be string. Floats will trigger an error.
        $this->rating = $rating . "";

        return $this;
    }
}