<?php

namespace MetroPublisher\Http\Guzzle;

use GuzzleHttp\Client;
use MetroPublisher\Http\HttpClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class GuzzleAdapter
 * @package Http\Guzzle
 */
class GuzzleAdapter implements HttpClientInterface
{
    /** @var  array */
    protected $options;

    /** @var  Client */
    protected $guzzle;

    public function __construct(Client $guzzle)
    {
        $this->guzzle  = $guzzle;
        $this->options = [];
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Sends GET request
     *
     * @param string $endpoint
     * @param array  $options
     *
     * @return ResponseInterface
     */
    public function get($endpoint, array $options = [])
    {
        return $this->guzzle->get($endpoint, $options);
    }

    /**
     * Sends PATCH request
     *
     * @param string $endpoint
     * @param array  $options
     *
     * @return ResponseInterface
     */
    public function patch($endpoint, array $options = [])
    {
        return $this->guzzle->patch($endpoint, $options);
    }

    /**
     * Sends PUT request
     *
     * @param string $endpoint
     * @param array  $options
     *
     * @return ResponseInterface
     */
    public function put($endpoint, array $options = [])
    {
        return $this->guzzle->put($endpoint, $options);
    }

    /**
     * Sends POST request
     *
     * @param string $endpoint
     * @param array  $options
     *
     * @return ResponseInterface
     */
    public function post($endpoint, array $options = [])
    {
        return $this->guzzle->post($endpoint, $options);
    }

    /**
     * Sends DELETE request
     *
     * @param string $endpoint
     * @param array  $options
     *
     * @return ResponseInterface
     */
    public function delete($endpoint, array $options = [])
    {
        return $this->guzzle->delete($endpoint, $options);
    }

    /**
     * @param boolean $isEnabled
     *
     * @return $this
     */
    public function setSslVerification($isEnabled)
    {
        if (!isset($this->options['verify']) || $this->options['verify'] != $isEnabled) {
            $this->options['verify'] = $isEnabled;
            $this->refreshGuzzleClient();
        }

        return $this;
    }

    /**
     * @param string $baseUri
     *
     * @return $this
     */
    public function setBaseUri($baseUri)
    {
        if (!isset($this->options['base_uri']) || $this->options['base_uri'] != $baseUri) {
            $this->options['base_uri'] = $baseUri;
            $this->refreshGuzzleClient();
        }

        return $this;
    }

    /**
     * @param $contentType
     *
     * @return HttpClientInterface
     */
    public function setDefaultContentType($contentType)
    {
        if (!is_array($this->options['headers'])) {
            $this->options['headers'] = array();
        }

        if (!isset($this->options['headers']['content-type']) || $this->options['headers']['content-type'] != $contentType) {
            $this->options['headers']['content-type'] = $contentType;
            $this->refreshGuzzleClient();
        }

        return $this;
    }

    /**
     * Build a new instance of Guzzle client.
     *
     * Guzzle does not allow for certain options to be changed after client instantiation.
     * A new instance of the client must be created to replace the current.
     */
    private function refreshGuzzleClient()
    {
        $this->guzzle = new Client($this->options);
    }
}