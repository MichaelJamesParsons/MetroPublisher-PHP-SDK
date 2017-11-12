<?php
namespace MetroPublisher\Api\Models\Meta;

/**
 * Class RRule
 * @package MetroPublisher\Api\Models\Meta
 */
class RRule
{
    const FREQ_SECONDLY = 'SECONDLY';
    const FREQ_MINUTELY = 'MINUTELY';
    const FREQ_HOURLY   = 'HOURLY';
    const FREQ_DAILY    = 'DAILY';
    const FREQ_WEEKLY   = 'WEEKLY';
    const FREQ_MONTHLY  = 'MONTHLY';
    const FREQ_YEARLY   = 'YEARLY';

    const DAY_SUNDAY    = 'SU';
    const DAY_MONDAY    = 'MO';
    const DAY_TUESDAY   = 'TU';
    const DAY_WEDNESDAY = 'WE';
    const DAY_THURSDAY  = 'TH';
    const DAY_FRIDAY    = 'FR';
    const DAY_SATURDAY  = 'SA';


    /** @var  string */
    protected $freq;

    /** @var  \DateTime */
    protected $until;

    /** @var  string */
    protected $count;

    /** @var  string */
    protected $interval;

    /** @var  string */
    protected $bySecond;

    /** @var  string */
    protected $byMinute;

    /** @var  string */
    protected $byHour;

    /** @var  string */
    protected $byDay;

    /** @var  string */
    protected $byMonth;

    /** @var  string */
    protected $byMonthDay;

    /** @var  string */
    protected $byYearDay;

    /** @var  string */
    protected $byWeekNo;

    /** @var  string */
    protected $bySetPos;

    /** @var  string */
    protected $weekStart;

    /** @var  \DateTime[] */
    protected $recurrenceDates;

    /** @var  \DateTime[] */
    protected $excludeDates;

    /**
     * @return string
     */
    public function getFreq()
    {
        return $this->freq;
    }

    /**
     * @param string $freq
     * @return $this
     */
    public function setFreq($freq)
    {
        $this->freq = $freq;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUntil()
    {
        return $this->until;
    }

    /**
     * @param \DateTime $until
     * @return $this
     */
    public function setUntil($until)
    {
        $this->until = $until;
        return $this;
    }

    /**
     * @return string
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param string $count
     * @return $this
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return string
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * @param string $interval
     * @return $this
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;

        return $this;
    }

    /**
     * @return string
     */
    public function getBySecond()
    {
        return $this->bySecond;
    }

    /**
     * @param string $bySecond
     * @return $this
     */
    public function setBySecond($bySecond)
    {
        $this->bySecond = $bySecond;

        return $this;
    }

    /**
     * @return string
     */
    public function getByMinute()
    {
        return $this->byMinute;
    }

    /**
     * @param string $byMinute
     * @return $this
     */
    public function setByMinute($byMinute)
    {
        $this->byMinute = $byMinute;

        return $this;
    }

    /**
     * @return string
     */
    public function getByHour()
    {
        return $this->byHour;
    }

    /**
     * @param string $byHour
     * @return $this
     */
    public function setByHour($byHour)
    {
        $this->byHour = $byHour;

        return $this;
    }

    /**
     * @return string
     */
    public function getByDay()
    {
        return $this->byDay;
    }

    /**
     * @param array $byDay
     *
     * @return $this
     */
    public function setByDay($byDay)
    {
        $this->byDay = $byDay;

        return $this;
    }

    /**
     * @return string
     */
    public function getByMonth()
    {
        return $this->byMonth;
    }

    /**
     * @param string $byMonth
     * @return $this
     */
    public function setByMonth($byMonth)
    {
        $this->byMonth = $byMonth;
        return $this;
    }

    /**
     * @return string
     */
    public function getByMonthDay()
    {
        return $this->byMonthDay;
    }

    /**
     * @param string $byMonthDay
     * @return $this
     */
    public function setByMonthDay($byMonthDay)
    {
        $this->byMonthDay = $byMonthDay;

        return $this;
    }

    /**
     * @return string
     */
    public function getByYearDay()
    {
        return $this->byYearDay;
    }

    /**
     * @param string $byYearDay
     * @return $this
     */
    public function setByYearDay($byYearDay)
    {
        $this->byYearDay = $byYearDay;

        return $this;
    }

    /**
     * @return string
     */
    public function getByWeekNo()
    {
        return $this->byWeekNo;
    }

    /**
     * @param string $byWeekNo
     * @return $this
     */
    public function setByWeekNo($byWeekNo)
    {
        $this->byWeekNo = $byWeekNo;

        return $this;
    }

    /**
     * @return string
     */
    public function getBySetPos()
    {
        return $this->bySetPos;
    }

    /**
     * @param string $bySetPos
     * @return $this
     */
    public function setBySetPos($bySetPos)
    {
        $this->bySetPos = $bySetPos;

        return $this;
    }

    /**
     * @return string
     */
    public function getWeekStart()
    {
        return $this->weekStart;
    }

    /**
     * @param string $weekStart
     * @return $this
     */
    public function setWeekStart($weekStart)
    {
        $this->weekStart = $weekStart;

        return $this;
    }

    /**
     * @return \DateTime[]
     */
    public function getRecurrenceDates()
    {
        return $this->recurrenceDates;
    }

    /**
     * @param \DateTime $recurrenceDates
     * @return $this
     */
    public function setRecurrenceDates($recurrenceDates)
    {
        $this->recurrenceDates = $recurrenceDates;

        return $this;
    }

    /**
     * @return \DateTime[]
     */
    public function getExcludeDates()
    {
        return $this->excludeDates;
    }

    /**
     * @param \DateTime[] $excludeDates
     * @return $this
     */
    public function setExcludeDates($excludeDates)
    {
        $this->excludeDates = $excludeDates;

        return $this;
    }
}