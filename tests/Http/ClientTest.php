<?php
namespace Http;

use MetroPublisher\Http\Client;
use MetroPublisher\Http\HttpClientInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class ClientTest extends TestCase
{
    public function testValidHttpMethodsAccepted() {

    }

    public function testInvalidHttpMethodsRejected() {

    }

    public function testAllStepsAreExecuted() {

    }

    public function testGetRequestsSendFieldsAsQueryParams() {
        $mockHttpClient = $this->createMock(HttpClientInterface::class);
        $mockHttpClient->expects($this->exactly(1))
            ->method('get')
            ->with($this->equalTo('/'), ['query' => ['name' => 'john doe']])
            ->willReturn($this->getMockHttpResponse());

        $mockSdkClient = $this->getMockSdkClient($mockHttpClient);
        $mockSdkClient->get('/', ['name' => 'john doe']);
    }

    public function testPatchRequestsSendFieldsAsJsonData()  {
        $mockHttpClient = $this->createMock(HttpClientInterface::class);
        $mockHttpClient->expects($this->exactly(1))
                       ->method('patch')
                       ->with($this->equalTo('/'), ['json' => ['name' => 'john doe']])
                       ->willReturn($this->getMockHttpResponse());

        $mockSdkClient = $this->getMockSdkClient($mockHttpClient);
        $mockSdkClient->patch('/', ['name' => 'john doe']);
    }

    public function testPostRequestsSendFieldsAsFormParams() {
        $mockHttpClient = $this->createMock(HttpClientInterface::class);
        $mockHttpClient->expects($this->exactly(1))
                       ->method('post')
                       ->with($this->equalTo('/'), ['form_params' => ['name' => 'john doe']])
                       ->willReturn($this->getMockHttpResponse());

        $mockSdkClient = $this->getMockSdkClient($mockHttpClient);
        $mockSdkClient->post('/', ['name' => 'john doe']);
    }

    private function getMockHttpResponse() {
        return $this->createMock(ResponseInterface::class);
    }

    private function getMockSdkClient($mockHttpClient) {
        $mockSdkClient = $this->getMockBuilder(Client::class)
                              ->setConstructorArgs([$mockHttpClient])
                              ->setMethods(['handleResponse'])
                              ->getMock();

        $mockSdkClient->expects($this->exactly(1))
                      ->method('handleResponse')
                      ->willReturn(null);

        return $mockSdkClient;
    }
}