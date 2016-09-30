<?php
namespace MetroPublisher;

use MetroPublisher\Http\GuzzleClient;
use MetroPublisher\Http\ConnectionException;
use MetroPublisher\Http\HttpClientInterface;

/**
 * Class MetroPublisher
 * @package MetroPublisher
 */
class MetroPublisher
{
    /** @var  string */
    private $apiKey;

    /** @var  string */
    private $secretKey;

    /** @var  string */
    private $bearer;

    /** @var  int */
    private $accountId;

    /** @var HttpClientInterface */
    public $client;

    /** @var  string */
    const API_BASE = "https://api.metropublisher.com";

    /** @var string */
    const O_AUTH_BASE = "https://go.metropublisher.com";

    public function __construct($key, $secret, HttpClientInterface $client = null)
    {
        $this->apiKey = $key;
        $this->secretKey = $secret;
        $this->client = ($client) ? $client : new GuzzleClient();

        $this->connect();
    }

    /**
     * @return string
     */
    public function getBearer()
    {
        return $this->bearer;
    }

    /**
     * @param string $bearer
     *
     * @return $this
     */
    public function setBearer($bearer)
    {
        $this->bearer = $bearer;

        return $this;
    }

    /**
     * Fetches OAuth token from MetroPublisher.
     *
     * @link https://api.metropublisher.com/narr/design.html#authentication
     *
     * @throws ConnectionException
     */
    private function connect() {
        $response = $this->client->get(self::O_AUTH_BASE, [
            "grant_type" => "client_credentials",
            "api_key"    => $this->apiKey,
            "api_secret" => $this->secretKey
        ]);

        if($response->getStatusCode() != 200) {
            throw new ConnectionException("Failed to fetch bearer. Please check API credentials.");
        }

        $body = $response->getBody();
        $this->accountId = $body['items'][0]['id'];
        $this->bearer = $body['access_token'];
    }

    public function get($resource, array $args = []) {
        return $this->client->get($this->buildApiBaseEndpoint() . $resource, $args);
    }

    public function post($resource, array $args = []) {
        return $this->client->post($this->buildApiBaseEndpoint() . $resource, $args);
    }

    public function put($resource, array $args = []) {
        return $this->client->put($this->buildApiBaseEndpoint() . $resource, $args);
    }

    public function delete($resource, array $args = []) {
        return $this->client->delete($this->buildApiBaseEndpoint() . $resource, $args);
    }

    private function buildApiBaseEndpoint() {
        return sprintf('%s/%s/', MetroPublisher::API_BASE, $this->accountId);
    }
}