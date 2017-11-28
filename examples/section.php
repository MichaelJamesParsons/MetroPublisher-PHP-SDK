<?php
use MetroPublisher\Api\Models\Section;
use MetroPublisher\MetroPublisher;

require "./config.php";

$metroPublisher = new MetroPublisher(MP_API_KEY, MP_API_SECRET);
$metroPublisher->getHttpClient()->setSslVerification(false);

// Create
$section = new Section($metroPublisher);
$section->setUuid('41b47ff8-3355-4f69-a867-7232165e6d29')
        ->setTitle('Lorem Ipsum')
        ->setUrlname('lorem-ipsum')
        ->setParentUuid(null)
        ->setAutoFeaturedStories(true)
        ->setAutoFeaturedStoriesNum(2)
        ->setExternalurl(null)
        ->setFeatureImageUrl(null)
        ->setHideInNav(null)
        ->setLeadStoryUrl(null)
        ->setMetaDescription(null)
        ->setMetaKeywords(null)
        ->setOrd(10)
        ->setShowPrevNext(true);

// Save
$section->save();


/*
 * Delete the section?
 * MetroPublisher's API does not support deleting a section.
 */