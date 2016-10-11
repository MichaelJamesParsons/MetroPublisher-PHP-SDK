<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\AbstractResourceModel;

/**
 * Class Location
 * @package MetroPublisher\Api\Models
 *
 * @property string $title
 * @property string $description
 * @property array  $coords
 * @property string $state
 * @property string $thumb_uuid
 * @property string $street
 * @property string $streetnumber
 * @property string $pcode
 * @property string $geoname_id
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $website
 * @property string $price_index
 * @property string $opening_hours
 * @property string $content
 * @property boolean  $closed
 * @property string   $print_description
 * @property string   $sort_title
 * @property boolean  $is_listing
 */
class Location extends AbstractResourceModel
{
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
     * @return array
     */
    public function getCoords()
    {
        return $this->coords;
    }

    /**
     * @param array $coords
     *
     * @return $this
     */
    public function setCoords($coords)
    {
        $this->coords = $coords;

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
    public function getThumbUuid()
    {
        return $this->thumb_uuid;
    }

    /**
     * @param string $thumb_uuid
     *
     * @return $this
     */
    public function setThumbUuid($thumb_uuid)
    {
        $this->thumb_uuid = $thumb_uuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     *
     * @return $this
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return string
     */
    public function getStreetnumber()
    {
        return $this->streetnumber;
    }

    /**
     * @param string $streetnumber
     *
     * @return $this
     */
    public function setStreetnumber($streetnumber)
    {
        $this->streetnumber = $streetnumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getPcode()
    {
        return $this->pcode;
    }

    /**
     * @param string $pcode
     *
     * @return $this
     */
    public function setPcode($pcode)
    {
        $this->pcode = $pcode;

        return $this;
    }

    /**
     * @return string
     */
    public function getGeonameId()
    {
        return $this->geoname_id;
    }

    /**
     * @param string $geoname_id
     *
     * @return $this
     */
    public function setGeonameId($geoname_id)
    {
        $this->geoname_id = $geoname_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param string $fax
     *
     * @return $this
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param string $website
     *
     * @return $this
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return string
     */
    public function getPriceIndex()
    {
        return $this->price_index;
    }

    /**
     * @param string $price_index
     *
     * @return $this
     */
    public function setPriceIndex($price_index)
    {
        $this->price_index = $price_index;

        return $this;
    }

    /**
     * @return string
     */
    public function getOpeningHours()
    {
        return $this->opening_hours;
    }

    /**
     * @param string $opening_hours
     *
     * @return $this
     */
    public function setOpeningHours($opening_hours)
    {
        $this->opening_hours = $opening_hours;

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
     * @return boolean
     */
    public function isClosed()
    {
        return $this->closed;
    }

    /**
     * @param boolean $closed
     *
     * @return $this
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrintDescription()
    {
        return $this->print_description;
    }

    /**
     * @param string $print_description
     *
     * @return $this
     */
    public function setPrintDescription($print_description)
    {
        $this->print_description = $print_description;

        return $this;
    }

    /**
     * @return string
     */
    public function getSortTitle()
    {
        return $this->sort_title;
    }

    /**
     * @param string $sort_title
     *
     * @return $this
     */
    public function setSortTitle($sort_title)
    {
        $this->sort_title = $sort_title;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsListing()
    {
        return $this->is_listing;
    }

    /**
     * @param boolean $is_listing
     *
     * @return $this
     */
    public function setIsListing($is_listing)
    {
        $this->is_listing = $is_listing;

        return $this;
    }

    protected function getFieldNames()
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
        ], parent::getFieldNames());
    }
}