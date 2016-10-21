<?php
namespace MetroPublisher\Api\Models\Resolvers;

/**
 * Interface ModelTypeResolverInterface
 * @package MetroPublisher\Api\Models\Resolvers
 */
interface ModelTypeResolverInterface
{
    /**
     * @param array $serializedModel
     *
     * @return string
     */
    public function resolve(array $serializedModel);
}