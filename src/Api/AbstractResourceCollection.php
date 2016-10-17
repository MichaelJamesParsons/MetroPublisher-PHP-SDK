<?php
namespace MetroPublisher\Api;

use MetroPublisher\Api\Models\AbstractModel;
use MetroPublisher\Api\Models\Resolvers\ModelResolver;
use MetroPublisher\Common\Serializers\ModelDeserializer;
use MetroPublisher\MetroPublisher;

/**
 * Class AbstractResourceCollection
 * @package MetroPublisher\Api
 */
abstract class AbstractResourceCollection extends AbstractApiResource
{
    /** @var  ModelDeserializer */
    protected $deserializer;

    /**
     * AbstractResourceCollection constructor.
     *
     * @param MetroPublisher $metroPublisher
     */
    public function __construct(MetroPublisher $metroPublisher)
    {
        parent::__construct($metroPublisher);
        $this->deserializer = new ModelDeserializer();
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

        return ModelDeserializer::convertCollection(
            new ModelResolver($this->getModelClass()),
            $response['items'],
            [$this->context]
        );
    }

    /**
     * @param $endpoint
     *
     * @return AbstractModel
     */
    public function find($endpoint) {
        $model = $this->client->get($this->getBaseUri() . $endpoint);
        return ModelDeserializer::convert(new ModelResolver($this->getModelClass()), $model, [$this->context]);
    }

    protected function getModelDefaultFields() {
        return call_user_func(sprintf('%s::%s', $this->getModelClass(), 'getDefaultFields'));
    }

    protected function getModelFieldNames() {
        return call_user_func(sprintf('%s::%s', $this->getModelClass(), 'getFieldNames'));
    }

    protected abstract function getModelClass();
}