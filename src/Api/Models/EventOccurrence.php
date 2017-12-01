<?php

namespace MetroPublisher\Api\Models;

use DateTime;

/**
 * Class EventOccurrence
 * @package MetroPublisher\Api\Models
 */
class EventOccurrence extends AbstractModel
{
    /** @var  string */
    protected $event_uuid;

    /** @var  DateTime */
    protected $dtstart;

    /** @var DateTime */
    protected $dtend;

    /**
     * @return string
     */
    public function getEventUuid()
    {
        return $this->event_uuid;
    }

    /**
     * @param string $event_uuid
     *
     * @return $this
     */
    public function setEventUuid($event_uuid)
    {
        $this->event_uuid = $event_uuid;

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

    public static function getDefaultFields()
    {
        return array(
            'event_uuid',
            'dtstart',
            'dtend'
        );
    }
}