<?php
use MetroPublisher\MetroPublisher;
use MetroPublisher\Api\Models\AlbumReview;

require "./config.php";

$metroPublisher = new MetroPublisher(MP_API_KEY, MP_API_SECRET);
$metroPublisher->getHttpClient()->setSslVerification(false);

// Create a new Album Review
$albumReview = new AlbumReview($metroPublisher);
$albumReview->setUuid('55547ff8-3355-4f69-a867-7232165e6d29')
            ->setUrlname('album-review')
            ->setTitle('Album Review')
            ->setMetaTitle('Lorem Ipsum')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
            ->setMetaDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
            ->setPrintDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
            ->setContent('<p>Quisque sed erat sed ex eleifend sollicitudin eu id ligula.</p>')
            ->setFeatureImageUuid(null)
            ->setTeaserImageUuid(null)
            ->setIssued(new DateTime('now'))
            ->setEvergreen(true)
            ->setIssued(new DateTime('now'))
            ->setAlbumTitle('Lorem ipsum')
            ->setRating(0)
            ->addAlbumBuyUrl('http://example.com', 'example')
            ->addAlbumProviderUrl('https://www.amazon.com/REST-Design-Rulebook-Mark-Masse/dp/1449310508')
            ->save();

// Delete the review
$albumReview->delete();