<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\AbstractResourceModel;

/**
 * Class Location
 * @package MetroPublisher\Api\Models
 *
 * @property string  $title
 * @property string  $description
 * @property array   $coords
 * @property string  $state
 * @property string  $thumb_uuid
 * @property string  $street
 * @property string  $streetnumber
 * @property string  $pcode
 * @property string  $geoname_id
 * @property string  $phone
 * @property string  $fax
 * @property string  $email
 * @property string  $website
 * @property string  $price_index
 * @property string  $opening_hours
 * @property string  $content
 * @property boolean $closed
 * @property string  $print_description
 * @property string  $sort_title
 * @property boolean $is_listing
 */
class Location extends AbstractResourceModel
{
    /**
     * @inheritdoc
     */
    public function save()
    {
        return $this->doSave("/locations/{$this->uuid}");
    }

    /**
     * @inheritdoc
     */
    public function delete() {
        return $this->doDelete("/locations/{$this->uuid}");
    }

    /**
     * @inheritdoc
     */
    public static function getMetaFields()
    {
        return array_merge([
            'title',
            'description',
            'coords',
            'state',
            'thumb_uuid',
            'street',
            'streetnumber',
            'pcode',
            'geoname_id',
            'phone',
            'fax',
            'email',
            'website',
            'price_index',
            'opening_hours',
            'content',
            'closed',
            'print_description',
            'sort_title',
            'is_listing'
        ], parent::getMetaFields());
    }

    /**
     * @inheritdoc
     */
    protected function loadMetaData()
    {
        return $this->context->get("/locations/{$this->uuid}");
    }
}