<?php
use MetroPublisher\MetroPublisher;
use MetroPublisher\Api\Models\BookReview;

require "./config.php";

$metroPublisher = new MetroPublisher(MP_API_KEY, MP_API_SECRET);
$metroPublisher->getHttpClient()->setSslVerification(false);

// Create
$bookReview = new BookReview($metroPublisher);
$bookReview->setUuid('55547ff8-3355-4f69-a867-7232165e6d29')
            ->setUrlname('book-review')
            ->setTitle('Book Review')
            ->setMetaTitle('Lorem Ipsum')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
            ->setMetaDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
            ->setPrintDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
            ->setContent('<p>Quisque sed erat sed ex eleifend sollicitudin eu id ligula.</p>')
            ->setFeatureImageUuid(null)
            ->setTeaserImageUuid(null)
            ->setIssued(new DateTime('now'))
            ->setEvergreen(true)
            ->setRating(4.5)
            ->setBookTitle('Lorem ipsum')
            ->setBookIsbn('xxxxxxxxxxxxx')
            ->setBookImageUuid(null)
            ->setBookIssued(new DateTime('now'))
            ->addBookBuyUrl('http://example.com', 'example')
            ->addBookProviderUrl('{URL to Amazon or iTunes}');

// Save
$bookReview->save();

// Delete
$bookReview->delete();