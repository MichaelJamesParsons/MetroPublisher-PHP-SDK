<<<<<<< HEAD
<?php
=======
<?php
use MetroPublisher\Api\Models\Meta\RRule;
use MetroPublisher\MetroPublisher;
use MetroPublisher\Api\Models\Event;

require "./config.php";

$metroPublisher = new MetroPublisher(MP_API_KEY, MP_API_SECRET);
$metroPublisher->getHttpClient()->setSslVerification(false);

// Define recurrence rule (if event is recurring)
// FREQ=WEEKLY;BYDAY=MO,TU;INTERVAL=1;UNTIL=20171025T040000Z
$rrule = new RRule();
$rrule->setFreq(RRule::FREQ_WEEKLY)
    ->setInterval(2)
    ->setByDay(array('MO','TU'))
    ->setUntil(new DateTime('3/1/2017'));

// Other useful methods
$rrule->setByHour(null)
    ->setByMinute(null)
    ->setByMonth(null)
    ->setByMonthDay(null)
    ->setByYearDay(null)
    ->setByWeekNo(null)
    ->setBySetPos(null)
    ->setWeekStart(RRule::DAY_SUNDAY);

// Create a new event
$event = new Event($metroPublisher);
$event->setUuid('55547ff8-3355-4f69-a867-7232165e6d29')
      ->setUrlname('lorem-ipsum-event')
      ->setTitle('Lorem Ipsum Event')
      ->setMetaTitle('Lorem Ipsum')
      ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
      ->setMetaDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
      ->setPrintDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
      ->setContent('<p>Quisque sed erat sed ex eleifend sollicitudin eu id ligula.</p>')
      ->setFeatureImageUuid(null)
      ->setTeaserImageUuid(null)
      ->setIssued(new DateTime('now'))
      ->setEvergreen(true);

$event->setLocationUuid(null)
      ->setLocationAlt('Silicon Valley, CA')
      ->setDtstart(new DateTime('1/1/2017 12:30:00'))
      ->setDtend(new DateTime('1/1/2017 14:00:00'))
      ->setWebsite('http://example.com')
      ->setPrices('1.00') // @todo verify in API
      ->setUserEmail('john.doe@example.com')
      ->setEmail('jane.doe@example.com')
      ->setPhone('1111111111')
      ->setRrule($rrule)
      ->setRdates(array(new DateTime('now'), new DateTime('now'), new DateTime('now')))
      ->setExdates(array(new DateTime('now')))
      ->setRecurrenceId(null)
      ->setIcalUid('123')
      ->setSortTitle(null);

// Save the event
$event->save();

// Delete the event
$event->delete();
>>>>>>> 6c42db5b7a240761d5a5c5ab2ffa45f71f68ed70