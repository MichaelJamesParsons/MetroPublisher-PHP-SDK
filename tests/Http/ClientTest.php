<?php
namespace Http;

use MetroPublisher\Http\Client;
use MetroPublisher\Http\HttpClientInterface;
use MetroPublisher\Http\Steps\HttpStepInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class ClientTest extends TestCase
{
    public function testValidHttpMethodsAccepted() {
        /** @var \PHPUnit_Framework_MockObject_MockObject|HttpClientInterface $mockSdkClient */
        $mockSdkClient = $this->createMock(Client::class);
        $mockSdkClient->method('execute')
            ->withAnyParameters()
            ->willReturn(null);

        $mockSdkClient->get('/');
        $mockSdkClient->patch('/');
        $mockSdkClient->post('/');
        $mockSdkClient->delete('/');
    }

    public function testInvalidHttpMethodsRejected() {
        $mockHttpClient = $this->createMock(HttpClientInterface::class);

        /** @var \PHPUnit_Framework_MockObject_MockObject|HttpClientInterface $mockSdkClient */
        $mockSdkClient = $this->createMock(Client::class);
        $mockSdkClient->method('execute')
                      ->withAnyParameters()
                      ->willReturn(null);

        $this->expectException(\BadMethodCallException::class);
        $client = new Client($mockHttpClient);
        $client->notValidHttpMethod('/', []);
    }

    public function testAllStepsAreExecuted() {
        $mockStep1 = $this->createMock(HttpStepInterface::class);
        $mockStep2 = $this->createMock(HttpStepInterface::class);
        $mockStep3 = $this->createMock(HttpStepInterface::class);
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

    /**
     * @param $mockHttpClient
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|HttpClientInterface
     */
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