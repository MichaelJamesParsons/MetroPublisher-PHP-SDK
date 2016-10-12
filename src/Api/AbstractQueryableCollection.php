<?php
namespace MetroPublisher\Api;

/**
 * Class AbstractQueryableCollection
 * @package MetroPublisher\Api
 */
abstract class AbstractQueryableCollection extends AbstractResourceCollection
{
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
