<?php

namespace MetroPublisher\Api;

use MetroPublisher\Api\Models\Exception\ModelValidationException;
use MetroPublisher\MetroPublisher;

trait DeletableResourceModelTrait
{
    /**
     * @param $endpoint
     *
     * @return array
     * @throws ModelValidationException
     */
    protected function doDelete($endpoint)
    {
        if (empty($this->uuid)) {
            throw new ModelValidationException('Cannot delete model of type ' . gettype($this) . '. No UUID is set.');
        }

        return $this->getContext()->delete($endpoint, $this->serialize());
    }

    /**
     * @return MetroPublisher
     */
    protected abstract function getContext();

    protected abstract function delete();
}