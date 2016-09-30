<?php
namespace MetroPublisher\Http;

use GuzzleHttp\Client;

/**
 * Class GuzzleClient
 * @package MetroPublisher\Http
 */
class GuzzleClient implements HttpClientInterface
{
    /** @var  Client */
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @inheritdoc
     */
    public function get($resource, array $args = [])
    {
        return $this->client->get($resource, $args);
    }

    /**
     * @inheritdoc
     */
    public function post($resource, array $args = [])
    {
        return $this->client->post($resource, $args);
    }

    /**
     * @inheritdoc
     */
    public function put($resource, array $args = [])
    {
        return $this->client->put($resource, $args);
    }

    /**
     * @inheritdoc
     */
    public function delete($resource, array $args = [])
    {
        return $this->client->delete($resource, $args);
    }
}