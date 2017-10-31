<?php
namespace MetroPublisher\Api\Models;

use DateTime;
use MetroPublisher\MetroPublisher;

/**
 * Class Event
 * @package MetroPublisher\Api\Models
 */
class Event extends Content
{
    /** @var  string */
    protected $location_uuid;

    /** @var  string */
    protected $location_alt;

    /** @var  DateTime */
    protected $dtstart;

    /** @var  DateTime */
    protected $dtend;

    /** @var  string */
    protected $website;

    /** @var  string */
    protected $prices;

    /** @var  string */
    protected $user_email;

    /** @var  string */
    protected $email;

    /** @var  string */
    protected $phone;

    /** @var  string */
    protected $rrule;

    /** @var  DateTime[] */
    protected $rdates;

    /** @var  DateTime[] */
    protected $exdates;

    /** @var  string */
    protected $recurrence_id;

    /** @var  string */
    protected $ical_uid;

    /** @var  string */
    protected $sort_title;

    /**
     * Event constructor.
     *
     * @param MetroPublisher $metroPublisher
     */
    public function __construct(MetroPublisher $metroPublisher)
    {
        parent::__construct($metroPublisher);
        $this->content_type = Content::CONTENT_TYPE_EVENT;
        $this->rdates = [];
        $this->exdates = [];
    }

    /**
     * @inheritdoc
     */
    public static function getMetaFields()
    {
        return array_merge([
            'location_uuid',
            'location_alt',
            'dtstart',
            'dtend',
            'website',
            'prices',
            'user_email',
            'email',
            'phone',
            'rrule',
            'rdates',
            'exdates',
            'recurrence_id',
            'ical_uid',
            'sort_title'
        ], parent::getMetaFields());
    }

    /**
     * @return string
     */
    public function getLocationUuid()
    {
        return $this->location_uuid;
    }

    /**
     * @param string $location_uuid
     *
     * @return $this
     */
    public function setLocationUuid($location_uuid)
    {
        $this->location_uuid = $location_uuid;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getLocationAlt()
    {
        return $this->location_alt;
    }

    /**
     * @param string $location_alt
     *
     * @return $this
     */
    public function setLocationAlt($location_alt)
    {
        $this->location_alt = $location_alt;
        
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDtstart()
    {
        return $this->dtstart;
    }

    /**
     * @param DateTime $dtstart
     *
     * @return $this
     */
    public function setDtstart($dtstart)
    {
        $this->dtstart = $dtstart;
        
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDtend()
    {
        return $this->dtend;
    }

    /**
     * @param DateTime $dtend
     *
     * @return $this
     */
    public function setDtend($dtend)
    {
        $this->dtend = $dtend;
        
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
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @param string $prices
     *
     * @return $this
     */
    public function setPrices($prices)
    {
        $this->prices = $prices;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * @param string $user_email
     *
     * @return $this
     */
    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;
        
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
    public function getRrule()
    {
        return $this->rrule;
    }

    /**
     * @param string $rrule
     *
     * @return $this
     */
    public function setRrule($rrule)
    {
        $this->rrule = $rrule;
        
        return $this;
    }

    /**
     * @return DateTime[]
     */
    public function getRdates()
    {
        return $this->rdates;
    }

    /**
     * @param DateTime[] $rdates
     *
     * @return $this
     */
    public function setRdates($rdates)
    {
        $this->rdates = $rdates;
        
        return $this;
    }

    /**
     * @return DateTime[]
     */
    public function getExdates()
    {
        return $this->exdates;
    }

    /**
     * @param DateTime[] $exdates
     *
     * @return $this
     */
    public function setExdates($exdates)
    {
        $this->exdates = $exdates;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getRecurrenceId()
    {
        return $this->recurrence_id;
    }

    /**
     * @param string $recurrence_id
     *
     * @return $this
     */
    public function setRecurrenceId($recurrence_id)
    {
        $this->recurrence_id = $recurrence_id;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getIcalUid()
    {
        return $this->ical_uid;
    }

    /**
     * @param string $ical_uid
     *
     * @return $this
     */
    public function setIcalUid($ical_uid)
    {
        $this->ical_uid = $ical_uid;
        
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
}