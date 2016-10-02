<?php
namespace MetroPublisher\Http\Steps;


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

        switch($body) {
            default:
                return new \Exception("Request failed.");
        }
    }
}