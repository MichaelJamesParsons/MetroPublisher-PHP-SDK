<?php
namespace MetroPublisher\Api;

use MetroPublisher\Common\Serializers\ModelArraySerializer;
use MetroPublisher\Common\Serializers\ModelSerializerInterface;
use MetroPublisher\Http\HttpClientInterface;
use MetroPublisher\MetroPublisher;

/**
 * Class AbstractApiResource
 * @package MetroPublisher\Api
 */
abstract class AbstractApiResource
{
    /** @var  MetroPublisher */
    protected $context;

    /** @var  HttpClientInterface */
    protected $client;

    /** @var  string */
    private $baseUri;

    /** @var ModelSerializerInterface */
    protected $serializer;

    /**
     * AbstractApiResource constructor.
     *
     * @param MetroPublisher $metroPublisher
     */
    public function __construct(MetroPublisher $metroPublisher) {
        $this->context = $metroPublisher;
        $this->client  = $metroPublisher->getClient();
        $this->baseUri = sprintf('%s/%s', $metroPublisher::API_BASE, $metroPublisher->getAccountId());
        $this->serializer = new ModelArraySerializer($metroPublisher);
    }

    protected function getBaseUri() {
        return $this->baseUri;
    }
}