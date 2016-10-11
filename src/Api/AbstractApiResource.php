<?php
namespace MetroPublisher\Api;

use MetroPublisher\Api\Models\AbstractModel;
use MetroPublisher\Http\HttpClientInterface;
use MetroPublisher\MetroPublisher;

/**
 * Class AbstractApiResource
 * @package MetroPublisher\Api
 */
abstract class AbstractApiResource extends AbstractModel
{
    /** @var  HttpClientInterface */
    protected $client;

    /** @var  string */
    private $baseUri;

    public function __construct(MetroPublisher $metroPublisher) {
        $this->client  = $metroPublisher->getClient();
        $this->baseUri = sprintf('%s/%s', $metroPublisher::API_BASE, $metroPublisher->getAccountId());
    }

    protected function getBaseUri() {
        return $this->baseUri;
    }
}