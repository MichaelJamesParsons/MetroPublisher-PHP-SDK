<?php
namespace MetroPublisher\Api\Models;

use DateTime;

/**
 * Class Event
 * @package MetroPublisher\Api\Models
 *
 * @property string     $location_uuid
 * @property string     $location_alt
 * @property DateTime   $dstart
 * @property DateTime   $dtend
 * @property string     $website
 * @property string     $prices
 * @property string     $user_email
 * @property string     $email
 * @property string     $phone
 * @property array      $rrule
 * @property array      $rdates
 * @property array      $exdates
 * @property array      $recurrence_id
 * @property string     $ical_uid
 * @property string     $sort_title
 */
class Event extends Content
{

}