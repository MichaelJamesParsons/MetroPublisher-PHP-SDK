<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\AbstractResourceModel;

/**
 * Class Slot
 * @package MetroPublisher\Api\Models
 *
 * @property string $content_uuid
 * @property string $relevance
 * @property string $display
 */
class Slot extends AbstractResourceModel
{
    public function save() {
        return parent::save("content/{$this->content_uuid}/slots/{$this->uuid}");
    }

    public function getMedia() {}
}