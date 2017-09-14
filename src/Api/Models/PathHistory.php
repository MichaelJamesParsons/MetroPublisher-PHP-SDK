<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\MetroPublisher;

/**
 * Class PathHistory
 * @package MetroPublisher\Api\Models
 *
 * @property string $path
 */
class PathHistory extends AbstractModel
{
    public function __construct(MetroPublisher $metroPublisher, $path)
    {
        parent::__construct($metroPublisher);
        $this->path = $path;
    }

    /**
     * @inheritdoc
     */
    public static function getFieldNames()
    {
        return ['path'];
    }
}