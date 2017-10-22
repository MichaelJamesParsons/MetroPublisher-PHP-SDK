
# MetroPublisher SDK Beta

[![Build Status](https://travis-ci.org/MichaelJamesParsons/MetroPublisher-PHP-SDK.svg?branch=version-0.x)](https://travis-ci.org/MichaelJamesParsons/MetroPublisher-PHP-SDK) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/634ce9c10a5b469bb8e3efc985454796)](https://www.codacy.com/app/mjay-parsons/MetroPublisher-PHP-API?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=MichaelJamesParsons/MetroPublisher-PHP-API&amp;utm_campaign=Badge_Grade) [![License](https://poser.pugx.org/michaeljamesparsons/metropublisher-php-sdk/license)](https://packagist.org/packages/michaeljamesparsons/metropublisher-php-sdk)

This is a fully featured SDK for the [MetroPublisher<sup>TM</sup> REST API](https://api.metropublisher.com/index.html). It takes care of the boilerplate HTTP client request/response logic for you so you can dive right into implementing the API into your app.

## Installation

The recommended method of installation is through [composer](https://getcomposer.org).

    composer require michaeljamesparsons/metropublisher-php-sdk

## Dependencies

* [`guzzle/guzzle`](https://github.com/guzzle/guzzle)
* [`phpdocumentor/reflection-docblock`](https://github.com/phpDocumentor/ReflectionDocBlock)

If you are using composer, these dependencies should be installed automatically.

## Quickstart

```php
<?php
use MetroPublisher\MetroPublisher;
use MetroPublisher\Api\Models\Article;

//Create a new MetroPublisher API instance
$metroPublisher = new MetroPublisher("{public key}", "{secret key}");

//Create a new article
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
    ->setEvergreen(true);

//Save the article
$article->save();

//Delete the article
$article->delete();
```

## Dictionary

### Models
A `model` represents an object in the MetroPublisher API. For example, this could be an article, event, location, or other object. The properties of these objects map to the fields defined for that object in the [official API resource reference](https://api.metropublisher.com/resources/index.html).

### Resource Models
A `resource model` is a type of model which, unlike non-resource models, can be saved to the API or deleted from it. Some resource models have extra methods that allow them to fetch other models that are related to them. Not all of the resource models have been implemented, but I've listed the ones that are ready for you below!

* Article
* Event
* AlbumReview
* BookReview
* LocationReview
* Location
* Tag
* TagCategory
* Slot
* ExternalSlotMedia
* EmbedSlotMedia
* FileSlotMedia

### Non-Resource Models
Non-resource models are dependent on another resource model to exist. For example, the `path_history` model cannot be saved or deleted from the API. It simply represents meta-data from another model.

* PathHistory

### Collections

Each resource model has a corresponding collection object. A collection object allows you to fetch groups of a resource model, an individual resource model, or groups of models that are related to the resource model.

```php
<?php
use MetroPublisher\Api\Collections\ArticleCollection;

$articleCollection = new ArticleCollection($metroPublisher);

//Get group of articles
$articles = $articleCollection->findAll();
    
//Get next group of articles
$moreArticles = $articleCollection->findAll(2);

//Get a single article
$singleArticle = $articleCollection->find('e6ebac9c-94cb-11e6-ae22-56b6b6499611');
```

## Tests
Unit tests are located in the `/tests` directory. Full coverage is in progress.

    ./vendor/bin/phpunit

## Todo
- [x] Implement HttpClient interface
- [ ] Cache parsed model annotations
- [ ] Support directly associating objects along side UUIDs
- [ ] Make collections iterable

## License

 Released under the MIT license.