<?php

namespace MetroPublisher\Api;

/**
 * Class TaggableInterface
 * @package MetroPublisher\Api
 */
interface TaggableInterface
{
    /**
     * Get the tags for a content object that represent a specific tag/content
     * relationship, defined by 'predicate'.
     *
     * The tags may be filtered by specifying a state. The 'approved' state is
     * used by default if the user is public. Otherwise, not filter will be
     * applied.
     *
     * @param string $predicate The targeted predicate.
     * @param string $state     The state of which the tags must have to be
     *                          included in the the results.
     *
     * @return array
     */
    public function getTagsWithPredicate($predicate, $state = 'approved');

    /**
     * Get the tags associated with the object.
     *
     * The tags may be filtered by specifying a state. The 'approved' state is
     * used by default if the user is public. Otherwise, not filter will be
     * applied.
     *
     * @param string $state The state of which the tags must have to be
     *                      included in the the results.
     *
     * @return array
     */
    public function getTags($state = 'approved');
}