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
        $contentTypeHeader = $response->getHeader('Content-Type');
        $contentType = (is_array($contentTypeHeader)) ? $contentTypeHeader[0] : $contentTypeHeader;

        if (strpos($contentType, 'application/json') !== false) {
            return json_decode($response->getBody()->getContents(), true);
        }

        return $response->getBody()->getContents();
    }
}