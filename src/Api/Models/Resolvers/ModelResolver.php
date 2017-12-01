<?php

namespace MetroPublisher\Api\Models\Resolvers;

/**
 * Class ModelResolver
 * @package MetroPublisher\Api\Models\Factory
 */
class ModelResolver implements ModelTypeResolverInterface
{
    /** @var  string */
    protected $type;

    /**
     * ModelResolver constructor.
     *
     * @param $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * @inheritdoc
     */
    public function resolve(array $serializedModel)
    {
        return $this->type;
    }
}