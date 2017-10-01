<?php
namespace MetroPublisher\Api;

use MetroPublisher\Common\Serializers\ModelArraySerializer;
use MetroPublisher\Common\Serializers\ModelSerializerInterface;
use MetroPublisher\MetroPublisher;

/**
 * Class AbstractApiResource
 * @package MetroPublisher\Api
 */
abstract class AbstractApiResource
{
    /** @var  MetroPublisher */
    protected $context;

    /** @var ModelSerializerInterface */
    protected $serializer;

    /**
     * AbstractApiResource constructor.
     *
     * @param MetroPublisher $metroPublisher
     */
    public function __construct(MetroPublisher $metroPublisher) {
        $this->context = $metroPublisher;
        $this->serializer = new ModelArraySerializer();
    }
}