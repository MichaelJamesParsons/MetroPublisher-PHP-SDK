<?php
namespace Api;

interface ResourceCollectionInterface
{
    /**
     * Retrieves all of a resource model's records.
     *
     * @param int $page
     * @param array $options
     * @return ResourceModelInterface[]
     */
    public function all($page = 1, array $options = []);

    /**
     * Retrieves a single resource model.
     *
     * Returns null of record is not found.
     *
     * @param string $uuid
     * @return ResourceModelInterface
     */
    public function find($uuid);
}