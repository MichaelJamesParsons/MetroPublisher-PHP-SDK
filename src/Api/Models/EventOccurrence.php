<?php
namespace MetroPublisher\Api\Models;

use DateTime;

/**
 * Class EventOccurrence
 * @package MetroPublisher\Api\Models
 */
class EventOccurrence extends AbstractModel
{
    /** @var  DateTime */
    protected $start_time;

    /** @var DateTime */
    protected $end_time;

    /**
     * @return DateTime
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * @param DateTime $start_time
     *
     * @return $this
     */
    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * @param DateTime $end_time
     *
     * @return $this
     */
    public function setEndTime($end_time)
    {
        $this->end_time = $end_time;

        return $this;
    }
}