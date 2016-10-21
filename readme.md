
# MetroPublisher SDK Beta

This is a fully featured SDK for the [MetroPublisher<sup>TM</sup> REST API](https://api.metropublisher.com/index.html). It takes care of the boilerplate HTTP client request/response logic for you so you can dive right into implementing the API into your app.

Complete documentation coming soon!

## Installation

The recommended method of installation is through [composer](https://getcomposer.org).

    composer require michaeljamesparsons/metropublisher-php-sdk

## Dependencies

* [`guzzle/guzzle`](https://github.com/guzzle/guzzle)
* [`phpdocumentor/reflection-docblock`](https://github.com/phpDocumentor/ReflectionDocBlock)

If you are using composer, these dependencies should be installed automatically.

## Quickstart

    use \MetroPublisher\MetroPublisher;
    use MetroPublisher\Api\Models\Article;
    use MetroPublisher\Api\Models\Content;
    ...
    
    //Create a new MetroPublisher API instance
    $metroPublisher = new \MetroPublisher\MetroPublisher($publicKey, $secretKey);
    
    //Create a new article
    $article = new Article($metroPublisher);
    $article->setUuid('e6ebac9c-94cb-11e6-ae22-56b6b6499611')
            ->setUrlname("lorem-ipsum")
            ->setTitle('Lorem Ipsum')
            ->setDescription('Parturient lacus a tempus.')
            ->setContent('<p>Parturient lacus a tempus sed ultricies nibh.</p>')
            ->setIssued(new DateTime('10/1/2016'))
            ->setState(Content::STATE_PUBLISHED);
    
    //Save the article
    $article->save();
    
    //Delete the article
    $article->delete();

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
    
    <?php
    ... 
    
    $articleCollection = new ArticleCollection($metroPublisher);
    
    //Get group of articles
    $articles =  $articleCollection->all();
        
    //Get next group of articles
    $moreArticles = $articleCollection->all(2);
    
    //Get a single article
    $singleArticle = $articleCollection->find('e6ebac9c-94cb-11e6-ae22-56b6b6499611');

## Tests

Comming soon!

## License

 Released under the MIT license.