<?php

namespace MetroPublisher\Http\Steps;

use Psr\Http\Message\ResponseInterface;

interface HttpStepInterface
{
    /**
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function handle(ResponseInterface $response);
}