<?php
namespace MetroPublisher\Api\Models;

/**
 * Class PathHistory
 * @package MetroPublisher\Api\Models
 */
class PathHistory extends AbstractModel
{
    /** @var  string */
    private $path;

    /**
     * @return string
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * @param $path
     */
    public function setPath($path) {
        $this->path = $path;
    }

    /**
     * @inheritdoc
     */
    public static function getFieldNames()
    {
        return [
            'path'
        ];
    }
}