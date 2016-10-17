<?php
namespace MetroPublisher\Api\Models\Resolvers;

use MetroPublisher\Api\Models\EmbedSlotMedia;
use MetroPublisher\Api\Models\ExternalSlotMedia;
use MetroPublisher\Api\Models\SlotMedia;

/**
 * Class SlotMediaResolver
 * @package MetroPublisher\Api\Models\Factory
 */
class SlotMediaResolver implements ModelTypeResolverInterface
{
    /**
     * @inheritdoc
     */
    public function resolve(array $serializedModel)
    {
        $type = (isset($serializedModel['type'])) ? $serializedModel['type'] : null;
        return $this->getFromType($type);
    }

    /**
     * @param $type
     *
     * @return string
     */
    protected function getFromType($type) {
        switch ($type) {
            case SlotMedia::TYPE_EMBED_CODE:
                return EmbedSlotMedia::class;
            case SlotMedia::TYPE_EXTERNAL_URL:
                return ExternalSlotMedia::class;
            case SlotMedia::TYPE_FILE:
                return SlotMedia::TYPE_FILE;
            default:
                return SlotMedia::class;
        }
    }
}