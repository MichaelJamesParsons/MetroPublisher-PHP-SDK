<?php
use MetroPublisher\MetroPublisher;
use MetroPublisher\Api\Models\Location;

require "./config.php";

$metroPublisher = new MetroPublisher(MP_API_KEY, MP_API_SECRET);
$metroPublisher->getHttpClient()->setSslVerification(false);

// Create
$location = new Location($metroPublisher, '55547ff8-3355-4f69-a867-7232165e6d29');
$location->setTitle('Lorem Ipsum')
    ->setUrlname('lorem-ipsum')
    ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ->setCoords([40.1965, -74.16848])
    ->setState(Location::STATE_DRAFT)
    ->setThumbUuid(null)
    ->setStreet('Columbus Avenue')
    ->setStreetNumber('325')
    ->setPcode('94133')
    ->setGeonameId('5391959')
    ->setPhone('(111) 111-1111')
    ->setFax('(222) 222-2222')
    ->setEmail('test@test.com')
    ->setWebsite('https://metropublisher.com')
    ->setPriceIndex(Location::PRICE_INDEX_FREE)
    ->setOpeningHours('Tuesday through Sunday 6PM - 11PM')
    ->setContent('<p>Quisque sed erat sed ex eleifend sollicitudin eu id ligula.</p>')
    ->setClosed(false)
    ->setSortTitle('Lorem Ipsum')
    ->setPrintDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ->setFbHeadline('Lorem Ipsum')
    ->setFbUrl('https://facebook.com/path/to/location/page')
    ->setFbShowFaces(false)
    ->setFbShowStream(true);

$location->setTwitterUsername('metropublisher')
    ->setIsListing(true)
    ->setCouponImgUuid(null)
    ->setCouponTitle(null)
    ->setCouponDescription(null)
    ->setCouponStart(null)
    ->setCouponExpires(null)
    ->setSponsored(true)
    ->setContactPerson('John Doe')
    ->setContactEmail('test@test.com')
    ->setListingStart(new DateTime('now'))
    ->setListingExpires(new DateTime('now'));

// Save
$location->save();

// Delete
$location->delete();