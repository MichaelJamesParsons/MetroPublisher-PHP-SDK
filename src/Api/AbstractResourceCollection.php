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
    protected $serializer;

    public function __construct(MetroPublisher $metroPublisher)
    {
        parent::__construct($metroPublisher);
        $this->serializer = new ResourceModelSerializer($metroPublisher);
    }

    protected function getAssociatedModelFields() {
        return call_user_func(sprintf('%s::%s', $this->getModelClass(), 'getFieldNames'));
    }

    protected abstract function getModelClass();
}