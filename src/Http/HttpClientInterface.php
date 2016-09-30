<?php
namespace MetroPublisher\Http;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface HttpClientInterface
 * @package MetroPublisher\Http
 */
interface HttpClientInterface
{
    /**
     * @param       $resource
     * @param array $args
     *
     * @return ResponseInterface
     */
    public function get($resource, array $args = []);

    /**
     * @param       $resource
     * @param array $args
     *
     * @return ResponseInterface
     */
    public function post($resource, array $args = []);

    /**
     * @param       $resource
     * @param array $args
     *
     * @return ResponseInterface
     */
    public function put($resource, array $args = []);

    /**
     * @param       $resource
     * @param array $args
     *
     * @return ResponseInterface
     */
    public function delete($resource, array $args = []);
}