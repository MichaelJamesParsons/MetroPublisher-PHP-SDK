<?php

namespace MetroPublisher\Api;

use MetroPublisher\MetroPublisher;

interface ApiResourceInterface
{
    /**
     * @return MetroPublisher
     */
    public function getContext();
}