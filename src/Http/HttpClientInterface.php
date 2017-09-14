<?php
namespace MetroPublisher\Http;

/**
 * Interface HttpClientInterface
 * @package MetroPublisher\Http
 */
interface HttpClientInterface
{
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
     * @return array
     */
    public function getDefaultOptions();

    /**
     * @param array $options
     */
    public function setDefaultOptions(array $options);

    public function get($endpoint, array $fields = [], array $options = []);
    public function patch($endpoint, array $fields = [], array $options = []);
    public function post($endpoint, array $fields = [], array $options = []);
    public function delete($endpoint, array $fields = [], array $options = []);
}