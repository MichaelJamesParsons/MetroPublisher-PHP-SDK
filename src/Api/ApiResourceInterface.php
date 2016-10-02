<?php
namespace MetroPublisher\Api;

/**
 * Interface ApiResourceInterface
 * @package MetroPublisher\Api
 */
interface ApiResourceInterface
{
    public function find(array $fields = [], $page = 1, $rpp = 10, array $orderBy = []);
    public function save(AbstractResourceModel $model);
    public function delete($uuid);
}