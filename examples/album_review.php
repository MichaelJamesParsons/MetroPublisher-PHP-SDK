<?php

use MetroPublisher\Api\Models\AlbumReview;
use MetroPublisher\MetroPublisher;

require "./config.php";

$metroPublisher = new MetroPublisher(MP_API_KEY, MP_API_SECRET);
$metroPublisher->getHttpClient()->setSslVerification(false);

// Create
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
    ->setRating(4.5)
    ->addAlbumBuyUrl('http://example.com', 'example')
    ->addAlbumProviderUrl('{URL to Amazon or iTunes}');

// Save
$albumReview->save();

// Delete
$albumReview->delete();