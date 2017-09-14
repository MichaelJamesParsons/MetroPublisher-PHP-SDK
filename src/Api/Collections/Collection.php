<?php
namespace MetroPublisher\Api\Collections;

use ArrayAccess;
use MetroPublisher\Api\Models\AbstractModel;

/**
 * Class Collection
 * @package MetroPublisher\Api\Collections
 */
class Collection implements ArrayAccess
{
    /** @var  AbstractModel[] */
    protected $collection;

    public function __construct()
    {
        $this->collection = [];
    }

    public function first() {
        return $this->offsetGet(0);
    }

    public function all() {
        return $this->collection;
    }

    /**
     * @inheritdoc
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->collection);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->collection[$offset] : null;
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->collection[] = $value;
        } else {
            $this->collection[$offset] = $value;
        }
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset)
    {
        unset($this->collection[$offset]);
    }
}