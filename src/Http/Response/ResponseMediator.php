<?php
namespace MetroPublisher\Http\Response;

use Psr\Http\Message\ResponseInterface;

/**
 * Class ResponseMediator
 * @package MetroPublisher\Http\Response
 */
class ResponseMediator
{
    public static function getContent(ResponseInterface $response) {
        return json_decode($response->getBody()->getContents(), true);
    }
}