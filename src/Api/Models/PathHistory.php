<?php
namespace MetroPublisher\Api\Models;

/**
 * Class PathHistory
 * @package MetroPublisher\Api\Models
 *
 * @property string $path
 */
class PathHistory extends AbstractModel
{
    public function getPath() {
        return $this->path;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    /**
     * @inheritdoc
     */
    public function getFieldNames()
    {
        return [
            'path'
        ];
    }
}