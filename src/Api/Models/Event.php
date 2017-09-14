<?php
namespace MetroPublisher\Api\Models;

use DateTime;

/**
 * Class Event
 * @package MetroPublisher\Api\Models
 *
 * @property string $location_uuid
 * @property string $location_alt
 * @property DateTime $dtstart;
 * @property DateTime $dtend;
 * @property string $website
 * @property array $prices
 * @property string $user_email
 * @property string $email
 * @property string $phone
 * @property string $rrule
 * @property DateTime[] $rdates
 * @property DateTime[] $exdates
 * @property string $recurrence_id
 * @property string $ical_id
 * @property string $sort_title
 */
class Event extends Content
{
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
}