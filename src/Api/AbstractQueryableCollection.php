<?php
namespace MetroPublisher\Api;

use MetroPublisher\Api\Models\AbstractModel;

/**
 * Class AbstractQueryableCollection
 * @package MetroPublisher\Api
 */
abstract class AbstractQueryableCollection extends AbstractResourceCollection
{
    /**
     * @param       $endpoint
     * @param int   $page
     * @param array $options
     *
     * @return array
     */
    public function all($endpoint, $page = 1, array $options = []) {
        $fields = $this->getAssociatedModelFields();
        return self::findBy($endpoint, $fields, $page, $options);
    }

    /**
     * @param $endpoint
     *
     * @return AbstractModel
     */
    public function find($endpoint) {
        return $this->serializer->serializeArrayToObject(
            $this->getModelClass(),
            $this->client->get($this->getBaseUri() . $endpoint),
            $this->getAssociatedModelFields()
        );
    }

    /**
     * @param       $endpoint
     * @param array $fields
     * @param int   $page
     * @param array $options
     *
     * @return array
     */
    public function findBy($endpoint, array $fields, $page = 1, array $options = [])
    {
        $options['fields'] = implode('-', $fields);
        $options['page']   = $page;
        $response = $this->client->get($this->getBaseUri() . $endpoint, $options, $this->client->getDefaultOptions());

        return $this->serializer->serializeArrayCollectionToObjects(
            $this->getModelClass(),
            $fields,
            $response['items']
        );
    }
}