<?php
namespace MetroPublisher\Http\Steps;

use Exception;
use MetroPublisher\Http\Exception\BadParametersException;
use MetroPublisher\Http\Exception\ResourceNotFoundException;
use MetroPublisher\Http\Response\ResponseMediator;
use Psr\Http\Message\ResponseInterface;

class HttpResponseExceptionThrower implements HttpStepInterface
{

    /**
     * @inheritdoc
     */
    public function handle(ResponseInterface $response)
    {
        if($response->getStatusCode() != 200) {
            throw $this->getError($response);
        }

        return $response;
    }

    /**
     * @param ResponseInterface $response
     *
     * @return \Exception
     */
    private function getError(ResponseInterface $response) {
        $body = ResponseMediator::getContent($response);

        switch($body['error']) {
            case 'bad_parameters':
                return new BadParametersException($body["error_description"], $body["error_info"]);
            case 'not_found':
                return new ResourceNotFoundException($body["error_description"]);
            default:
                return new Exception("Request failed.");
        }
    }
}