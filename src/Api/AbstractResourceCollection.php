<?php
namespace MetroPublisher\Api;

use MetroPublisher\Api\Models\AbstractModel;
use MetroPublisher\Api\Models\Serializers\ResourceModelSerializer;
use MetroPublisher\MetroPublisher;

/**
 * Class AbstractResourceCollection
 * @package MetroPublisher\Api
 */
abstract class AbstractResourceCollection extends AbstractApiResource
{
    /** @var ResourceModelSerializer */
    protected $serializer;

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
        $fields = $this->getModelDefaultFields();

        $options['fields'] = implode('-', $fields);
        $options['page']   = $page;
        $response = $this->client->get($this->getBaseUri() . $endpoint, $options);

        return $this->serializer->serializeArrayCollectionToObjects(
            $this->getModelClass(),
            $fields,
            $response['items']
        );
    }

    /**
     * @param $endpoint
     *
     * @return AbstractModel
     */
    public function find($endpoint) {
        return $this->serializer->serializeArrayToObject(
            $this->getModelClass(),
            $this->getModelFieldNames(),
            $this->client->get($this->getBaseUri() . $endpoint)
        );
    }

    protected function getModelDefaultFields() {
        return call_user_func(sprintf('%s::%s', $this->getModelClass(), 'getDefaultFields'));
    }

    protected function getModelFieldNames() {
        return call_user_func(sprintf('%s::%s', $this->getModelClass(), 'getFieldNames'));
    }

    protected abstract function getModelClass();
}