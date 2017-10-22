<?php
namespace MetroPublisher\Api\Models;

use DateTime;

/**
 * Class EventOccurrence
 * @package MetroPublisher\Api\Models
 *
 * @property string $event_uuid
 * @property DateTime $start_time
 * @property DateTime $end_time
 */
class EventOccurrence extends AbstractModel
{
    public static function getDefaultFields()
    {
        return [
            'event_uuid',
            'start_time',
            'end_time'
        ];
    }
}