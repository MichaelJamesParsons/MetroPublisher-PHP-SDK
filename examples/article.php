<?php
use MetroPublisher\MetroPublisher;
use MetroPublisher\Api\Models\Article;

require "./config.php";

$metroPublisher = new MetroPublisher(MP_API_KEY, MP_API_SECRET);
$metroPublisher->getHttpClient()->setSslVerification(false);

// Create a new article
$article = new Article($metroPublisher);
$article->setUuid('41b47ff8-3355-4f69-a867-7232165e6d29')
    ->setUrlname('lorem-ipsum')
    ->setTitle('Lorem Ipsum')
    ->setMetaTitle('Lorem Ipsum')
    ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ->setMetaDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ->setPrintDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ->setContent('<p>Quisque sed erat sed ex eleifend sollicitudin eu id ligula.</p>')
    ->setFeatureImageUuid(null)
    ->setTeaserImageUuid(null)
    ->setIssued(new DateTime('now'))
    ->setEvergreen(true)
    ->save();

// Delete the article
$article->delete();