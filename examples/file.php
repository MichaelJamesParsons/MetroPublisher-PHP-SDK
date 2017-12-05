<?php

use MetroPublisher\Api\Models\File;
use MetroPublisher\MetroPublisher;

require "./config.php";

$metroPublisher = new MetroPublisher(MP_API_KEY, MP_API_SECRET);
$metroPublisher->getHttpClient()->setSslVerification(false);

$file = new File($metroPublisher);
$file->setTitle('Lorem Ipsum')
    ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ->setFilename('lorem_ipsum.jpg')
    ->setFileType('image/jpg')
    ->setCredits('John Doe')

    /*
     * Files can be replaced by using setFileContent() before saving. The
     * API doesn't return the original file contents after it has been
     * saved, so no getFileContent method exists.
     */
    ->setFileContent(file_get_contents('/path/to/lorem_ipsum.jpg'));

// Save
$file->save();

// Delete
$file->delete();
