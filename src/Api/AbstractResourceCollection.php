<?php
namespace MetroPublisher\Api;

use MetroPublisher\Api\Models\Serializers\ResourceModelSerializer;
use MetroPublisher\MetroPublisher;

/**
 * Class AbstractResourceCollection
 * @package MetroPublisher\Api
 */
abstract class AbstractResourceCollection extends AbstractApiResource
{
    /** @var ResourceModelSerializer */
    private $serializer;

    public function __construct(MetroPublisher $metroPublisher)
    {
        parent::__construct($metroPublisher);
        $this->serializer = new ResourceModelSerializer($metroPublisher);
    }

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
     * @return AbstractResourceModel
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

    private function getAssociatedModelFields() {
        return call_user_func(sprintf('%s::%s', $this->getModelClass(), 'getFieldNames'));
    }

    protected abstract function getModelClass();
}