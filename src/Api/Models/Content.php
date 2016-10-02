<?php
namespace MetroPublisher\Api;

use DateTime;

/**
 * Class Content
 * @package MetroPublisher\Api\Content
 *
 * @property string $content_type
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $state
 * @property string $meta_title
 * @property string $meta_description
 * @property string $print_description
 * @property datetime $issued
 * @property string $urlname
 * @property boolean $evergreen
 * @property string teaser_image_uuid
 * @property string feature_image_uuid
 *
 * - tags
 * - files
 * - slots
 * - redirect
 * - pathHistory
 * - comments
 */
class Content extends AbstractResourceModel
{
    const CONTENT_TYPE_ARTICLE = 'article';
    const CONTENT_TYPE_EVENT   = 'event';
    const CONTENT_TYPE_REVIEW  = 'review'; //Same as review_location
    const CONTENT_TYPE_REVIEW_ALBUM = 'review_album';
    const CONTENT_TYPE_REVIEW_BOOK  = 'review_book';
    const CONTENT_TYPE_REVIEW_PRODUCT = 'review_product';
    const CONTENT_TYPE_REVIEW_LOCATION  = 'review_location';
    const CONTENT_TYPE_ROUNDUP_LOCATION = 'roundup_location';

    const STATE_PUBLISHED = 'published';
    const STATE_DRAFT = 'draft';

    public function save() {
        return parent::save("content/{$this->uuid}");
    }

    public function delete() {
        return parent::delete("content/{$this->uuid}");
    }

    public function getInfo() {}
    public function getRelatedLinks() {}
    public function getTags() {}
    public function getTagsWithPredicate() {}
    public function getSlots() {}
    public function getSlot($uuid) {}
    public function getPathHistory() {}


    public static function getFieldNames()
    {
        return [
            'content_type',
            'title',
            'description',
            'state',
            'issued',
            'urlname',
        ];
    }
}