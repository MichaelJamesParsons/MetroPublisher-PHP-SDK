<?php
namespace MetroPublisher\Api;

/**
 * Class AbstractResourceCollection
 * @package MetroPublisher\Api
 */
abstract class AbstractResourceCollection extends AbstractApiResource
{
    /**
     * @param       $endpoint
     * @param int   $page
     * @param array $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function all($endpoint, $page = 1, array $options = []) {
        $fields = $this->getAssociatedModelFields();
        return self::findBy($endpoint, $fields, $page, $options);
    }

    /**
     * @param $endpoint
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function find($endpoint) {
        return $this->client->get($this->getBaseUri() . $endpoint);
    }

    /**
     * @param       $endpoint
     * @param array $fields
     * @param int   $page
     * @param array $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function findBy($endpoint, array $fields, $page = 1, array $options = [])
    {
        $options['fields'] = implode('-', $fields);
        $options['page']   = $page;

        return $this->client->get($this->getBaseUri() . $endpoint, $options, $this->client->getDefaultOptions());
    }

    private function getAssociatedModelFields() {
        return call_user_func(sprintf('%s::%s', $this->getModelClass(), 'getFieldNames'));
    }

    protected abstract function getModelClass();
}