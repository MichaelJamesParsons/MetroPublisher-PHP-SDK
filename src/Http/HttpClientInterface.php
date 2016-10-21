<?php
namespace MetroPublisher\Http;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface HttpClientInterface
 * @package MetroPublisher\Http
 */
interface HttpClientInterface
{
    public function __construct(array $steps = []);

    /**
     * @param       $method
     * @param       $endpoint
     * @param array $fields
     * @param array $options
     *
     * @return string
     */
    public function execute($method, $endpoint, array $fields = [], array $options = []);

    /**
     * @param ResponseInterface $response
     *
     * @return string
     */
    public function handleResponse(ResponseInterface $response);

    /**
     * @return array
     */
    public function getDefaultOptions();

    /**
     * @param array $options
     */
    public function setDefaultOptions(array $options);
}