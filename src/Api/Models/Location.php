<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\AbstractResourceModel;

/**
 * Class Location
 * @package MetroPublisher\Api\Models
 */
class Location extends AbstractResourceModel
{
    /** @var  string */
    protected $title;

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

    /** @var string **/
    protected $location_types;

    /** @var boolean **/
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

    /** @var  string */
    protected $listing_start;

    /** @var  \DateTime */
    protected $listing_expires;

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
            'location_types',
            'closed',
            'sort_title',
            'print_description',
            'fb_headline',
            'fb_url',
            'fb_show_faces',
            'fb_show_stream',
            'twitter_username',
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

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string[]
     */
    public function getCoords()
    {
        return $this->coords;
    }

    /**
     * @param string[] $coords
     */
    public function setCoords($coords)
    {
        $this->coords = $coords;
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
     */
    public function setState($state)
    {
        $this->state = $state;
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
     */
    public function setThumbUuid($thumb_uuid)
    {
        $this->thumb_uuid = $thumb_uuid;
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
     */
    public function setStreet($street)
    {
        $this->street = $street;
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
     */
    public function setStreetNumber($street_number)
    {
        $this->street_number = $street_number;
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
     */
    public function setPcode($pcode)
    {
        $this->pcode = $pcode;
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
     */
    public function setGeonameId($geoname_id)
    {
        $this->geoname_id = $geoname_id;
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
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
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
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
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
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     */
    public function setWebsite($website)
    {
        $this->website = $website;
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
     */
    public function setPriceIndex($price_index)
    {
        $this->price_index = $price_index;
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
     */
    public function setOpeningHours($opening_hours)
    {
        $this->opening_hours = $opening_hours;
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
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getLocationTypes()
    {
        return $this->location_types;
    }

    /**
     * @param string $location_types
     */
    public function setLocationTypes($location_types)
    {
        $this->location_types = $location_types;
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
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;
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
     */
    public function setSortTitle($sort_title)
    {
        $this->sort_title = $sort_title;
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
     */
    public function setPrintDescription($print_description)
    {
        $this->print_description = $print_description;
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
     */
    public function setFbHeadline($fb_headline)
    {
        $this->fb_headline = $fb_headline;
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
     */
    public function setFbUrl($fb_url)
    {
        $this->fb_url = $fb_url;
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
     */
    public function setFbShowFaces($fb_show_faces)
    {
        $this->fb_show_faces = $fb_show_faces;
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
     */
    public function setFbShowStream($fb_show_stream)
    {
        $this->fb_show_stream = $fb_show_stream;
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
     */
    public function setTwitterUsername($twitter_username)
    {
        $this->twitter_username = $twitter_username;
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
     */
    public function setIsListing($is_listing)
    {
        $this->is_listing = $is_listing;
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
     */
    public function setCouponImgUuid($coupon_img_uuid)
    {
        $this->coupon_img_uuid = $coupon_img_uuid;
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
     */
    public function setCouponTitle($coupon_title)
    {
        $this->coupon_title = $coupon_title;
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
     * @return $this
     */
    public function setCouponDescription($coupon_description)
    {
        $this->coupon_description = $coupon_description;

        return $this;
    }

    /**
     * @return string
     */
    public function getCouponStart()
    {
        return $this->coupon_start;
    }

    /**
     * @param string $coupon_start
     * @return $this
     */
    public function setCouponStart($coupon_start)
    {
        $this->coupon_start = $coupon_start;

        return $this;
    }

    /**
     * @return string
     */
    public function getCouponExpires()
    {
        return $this->coupon_expires;
    }

    /**
     * @param string $coupon_expires
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
     * @return $this
     */
    public function setContactEmail($contact_email)
    {
        $this->contact_email = $contact_email;

        return $this;
    }

    /**
     * @return string
     */
    public function getListingStart()
    {
        return $this->listing_start;
    }

    /**
     * @param string $listing_start
     * @return $this
     */
    public function setListingStart($listing_start)
    {
        $this->listing_start = $listing_start;

        return $this;
    }

    /**
     * @return string
     */
    public function getListingExpires()
    {
        return $this->listing_expires;
    }

    /**
     * @param string $listing_expires
     * @return $this
     */
    public function setListingExpires($listing_expires)
    {
        $this->listing_expires = $listing_expires;

        return $this;
    }
}