<?php

namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\AbstractResourceModel;
use MetroPublisher\Api\DeletableResourceModelTrait;

/**
 * Class Location
 * @package MetroPublisher\Api\Models
 */
class Location extends AbstractResourceModel
{
    use DeletableResourceModelTrait;

    /** @var  string */
    protected $title;

    /** @var  string */
    protected $urlname;

    /** @var  string */
    protected $description;

    /** @var  string[] */
    protected $coords;

    /** @var  string */
    protected $state;

    /** @var  string */
    protected $thumb_uuid;

    /** @var  string */
    protected $street;

    /** @var  string */
    protected $street_number;

    /** @var  string */
    protected $pcode;

    /** @var  string */
    protected $geoname_id;

    /** @var  string */
    protected $phone;

    /** @var  string */
    protected $fax;

    /** @var  string */
    protected $email;

    /** @var  string */
    protected $website;

    /** @var  string */
    protected $price_index;

    /** @var  string */
    protected $opening_hours;

    /** @var  string */
    protected $content;

    /** @var boolean * */
    protected $closed;

    /** @var  string */
    protected $sort_title;

    /** @var  string */
    protected $print_description;

    /** @var  string */
    protected $fb_headline;

    /** @var  string */
    protected $fb_url;

    /** @var  boolean */
    protected $fb_show_faces;

    /** @var  boolean */
    protected $fb_show_stream;

    /** @var  string */
    protected $twitter_username;

    /** @var boolean */
    protected $is_listing;

    /** @var  string */
    protected $coupon_img_uuid;

    /** @var  string */
    protected $coupon_title;

    /** @var  string */
    protected $coupon_description;

    /** @var  \DateTime */
    protected $coupon_start;

    /** @var  \DateTime */
    protected $coupon_expires;

    /** @var  string */
    protected $sponsored;

    /** @var  string */
    protected $contact_person;

    /** @var  string */
    protected $contact_email;

    /** @var  \DateTime */
    protected $listing_start;

    /** @var  \DateTime */
    protected $listing_expires;

    const STATE_DRAFT = 'draft';
    const STATE_PUBLISHED = 'published';

    const PRICE_INDEX_FREE = 'free';
    const PRICE_INDEX_INEXPENSIVE = 'inexpensive';
    const PRICE_INDEX_MODERATE = 'moderate';
    const PRICE_INDEX_EXPENSIVE = 'expensive';
    const PRICE_INDEX_VERY_EXPENSIVE = 'very_expensive';

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
    public function delete()
    {
        return $this->doDelete("/locations/{$this->uuid}");
    }

    public static function getDefaultFields()
    {
        return array_merge([
            'uuid',
            'title',
            'urlname',
            'coords',
        ]);
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
            'state',
            'thumb_uuid',
            'street',
            'street_number',
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
            'sort_title',
            'print_description',
            'fb_headline',
            'fb_url',
            'fb_show_faces',
            'fb_show_stream',
            'twitter_username',
            'is_listing',
            'coupon_img_uuid',
            'coupon_title',
            'coupon_description',
            'coupon_start',
            'coupon_expires',
            'sponsored',
            'contact_person',
            'contact_email',
            'listing_start',
            'listing_expires'
        ], parent::getMetaFields());
    }

    /**
     * @inheritdoc
     */
    protected function loadMetaData()
    {
        return $this->context->get("/locations/{$this->uuid}");
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

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
     *
     * @return $this
     */
    public function setUrlname($urlname)
    {
        $this->urlname = $urlname;

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
     * @return string[]
     */
    public function getCoords()
    {
        return $this->coords;
    }

    /**
     * @param int[] $coords
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
    public function getStreetNumber()
    {
        return $this->street_number;
    }

    /**
     * @param string $street_number
     *
     * @return $this
     */
    public function setStreetNumber($street_number)
    {
        $this->street_number = $street_number;

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
     * @return bool
     */
    public function isClosed()
    {
        return $this->closed;
    }

    /**
     * @param bool $closed
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
    public function getFbHeadline()
    {
        return $this->fb_headline;
    }

    /**
     * @param string $fb_headline
     *
     * @return $this
     */
    public function setFbHeadline($fb_headline)
    {
        $this->fb_headline = $fb_headline;

        return $this;
    }

    /**
     * @return string
     */
    public function getFbUrl()
    {
        return $this->fb_url;
    }

    /**
     * @param string $fb_url
     *
     * @return $this
     */
    public function setFbUrl($fb_url)
    {
        $this->fb_url = $fb_url;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFbShowFaces()
    {
        return $this->fb_show_faces;
    }

    /**
     * @param bool $fb_show_faces
     *
     * @return $this
     */
    public function setFbShowFaces($fb_show_faces)
    {
        $this->fb_show_faces = $fb_show_faces;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFbShowStream()
    {
        return $this->fb_show_stream;
    }

    /**
     * @param bool $fb_show_stream
     *
     * @return $this
     */
    public function setFbShowStream($fb_show_stream)
    {
        $this->fb_show_stream = $fb_show_stream;

        return $this;
    }

    /**
     * @return string
     */
    public function getTwitterUsername()
    {
        return $this->twitter_username;
    }

    /**
     * @param string $twitter_username
     *
     * @return $this
     */
    public function setTwitterUsername($twitter_username)
    {
        $this->twitter_username = $twitter_username;

        return $this;
    }

    /**
     * @return bool
     */
    public function isListing()
    {
        return $this->is_listing;
    }

    /**
     * @param bool $is_listing
     *
     * @return $this
     */
    public function setIsListing($is_listing)
    {
        $this->is_listing = $is_listing;

        return $this;
    }

    /**
     * @return string
     */
    public function getCouponImgUuid()
    {
        return $this->coupon_img_uuid;
    }

    /**
     * @param string $coupon_img_uuid
     *
     * @return $this
     */
    public function setCouponImgUuid($coupon_img_uuid)
    {
        $this->coupon_img_uuid = $coupon_img_uuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getCouponTitle()
    {
        return $this->coupon_title;
    }

    /**
     * @param string $coupon_title
     *
     * @return $this
     */
    public function setCouponTitle($coupon_title)
    {
        $this->coupon_title = $coupon_title;

        return $this;
    }

    /**
     * @return string
     */
    public function getCouponDescription()
    {
        return $this->coupon_description;
    }

    /**
     * @param string $coupon_description
     *
     * @return $this
     */
    public function setCouponDescription($coupon_description)
    {
        $this->coupon_description = $coupon_description;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCouponStart()
    {
        return $this->coupon_start;
    }

    /**
     * @param \DateTime $coupon_start
     *
     * @return $this
     */
    public function setCouponStart($coupon_start)
    {
        $this->coupon_start = $coupon_start;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCouponExpires()
    {
        return $this->coupon_expires;
    }

    /**
     * @param \DateTime $coupon_expires
     *
     * @return $this
     */
    public function setCouponExpires($coupon_expires)
    {
        $this->coupon_expires = $coupon_expires;

        return $this;
    }

    /**
     * @return string
     */
    public function getSponsored()
    {
        return $this->sponsored;
    }

    /**
     * @param string $sponsored
     *
     * @return $this
     */
    public function setSponsored($sponsored)
    {
        $this->sponsored = $sponsored;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactPerson()
    {
        return $this->contact_person;
    }

    /**
     * @param string $contact_person
     *
     * @return $this
     */
    public function setContactPerson($contact_person)
    {
        $this->contact_person = $contact_person;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contact_email;
    }

    /**
     * @param string $contact_email
     *
     * @return $this
     */
    public function setContactEmail($contact_email)
    {
        $this->contact_email = $contact_email;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getListingStart()
    {
        return $this->listing_start;
    }

    /**
     * @param \DateTime $listing_start
     *
     * @return $this
     */
    public function setListingStart($listing_start)
    {
        $this->listing_start = $listing_start;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getListingExpires()
    {
        return $this->listing_expires;
    }

    /**
     * @param \DateTime $listing_expires
     *
     * @return $this
     */
    public function setListingExpires($listing_expires)
    {
        $this->listing_expires = $listing_expires;

        return $this;
    }
}