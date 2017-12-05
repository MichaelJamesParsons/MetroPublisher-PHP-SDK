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
     */
    protected function doDelete($endpoint)
    {
        return $this->getContext()->delete($endpoint, $this->serialize());
    }

    /**
     * @return MetroPublisher
     */
    protected abstract function getContext();

    protected abstract function delete();
}