<?php

namespace MetroPublisher\Common\Serializers;

use MetroPublisher\Api\Models\AbstractModel;

/**
 * Interface ModelSerializerInterface
 * @package MetroPublisher\Api\Models\Serializers
 */
interface ModelSerializerInterface
{
    /**
     * @param AbstractModel $object
     *
     * @return string
     */
    public function serialize(AbstractModel $object);
}