<?php
namespace MetroPublisher\Api\Collections;

use MetroPublisher\Api\Collection\Exception\InvalidCollectionValueException;
use MetroPublisher\Api\Models\AbstractModel;

/**
 * Class ModelCollection
 * @package MetroPublisher\Api\Collections
 */
class ModelCollection extends Collection
{
    /**
     * Add a model to the collection
     *
     * @param string        $offset
     * @param AbstractModel $value
     *
     * @throws InvalidCollectionValueException
     */
    public function offsetSet($offset, $value)
    {
        if(!($value instanceof AbstractModel)) {
            throw new InvalidCollectionValueException(sprintf("ModelCollection expects AbstractModel, %s given.",
                gettype($value)
            ));
        }
        parent::offsetSet($offset, $value);
    }
}