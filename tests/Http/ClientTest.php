<?php
namespace Http;

use MetroPublisher\Http\HttpClientInterface;
use MetroPublisher\MetroPublisher;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ClientTest extends TestCase
{
    public function testValidHttpMethodsAccepted() {
        $mockHttpClient = $this->createMock(HttpClientInterface::class);
        $mockHttpClient->expects($this->once())
                       ->method('get')
                       ->willReturn($this->getMockHttpResponse());

        $mockHttpClient->expects($this->once())
                       ->method('post')
                       ->willReturn($this->getMockHttpResponse());

        $mockHttpClient->expects($this->once())
                       ->method('put')
                       ->willReturn($this->getMockHttpResponse());

        $mockHttpClient->expects($this->once())
                       ->method('patch')
                       ->willReturn($this->getMockHttpResponse());

        $mockHttpClient->expects($this->once())
                       ->method('delete')
                       ->willReturn($this->getMockHttpResponse());

        $mockHttpClient->expects($this->exactly(5))
                       ->method('getOptions')
                       ->willReturn([]);

        $mockMetroPublisher = new MetroPublisher(null, null, $mockHttpClient);
        $mockMetroPublisher->get('/', [], [], true);
        $mockMetroPublisher->post('/', [], [], true);
        $mockMetroPublisher->put('/', [], [], true);
        $mockMetroPublisher->patch('/', [], [], true);
        $mockMetroPublisher->delete('/', [], [], true);
    }

    public function testInvalidHttpMethodsRejected() {
        $client = new MetroPublisher(null, null);
        $this->expectException(\BadMethodCallException::class);

        // Attempt to dynamically call a non-http method
        $client->notValidHttpMethod('/', []);
    }

    public function testGetRequestsSendFieldsAsQueryParams() {
        $mockHttpClient = $this->createMock(HttpClientInterface::class);
        $mockHttpClient->expects($this->once())
            ->method('get')
            ->with($this->equalTo('/'), ['query' => ['name' => 'john doe']])
            ->willReturn($this->getMockHttpResponse());

        $mockHttpClient->expects($this->exactly(1))
                       ->method('getOptions')
                       ->willReturn([]);

        $metroPublisher = new MetroPublisher(null, null, $mockHttpClient);
        $metroPublisher->get('/', ['name' => 'john doe'], [], true);
    }

    public function testPatchRequestsSendFieldsAsJsonData()  {
        $mockHttpClient = $this->createMock(HttpClientInterface::class);
        $mockHttpClient->expects($this->once())
                       ->method('patch')
                       ->with($this->equalTo('/'), ['json' => ['name' => 'john doe']])
                       ->willReturn($this->getMockHttpResponse());

        $mockHttpClient->expects($this->exactly(1))
                       ->method('getOptions')
                       ->willReturn([]);

        /** @var MetroPublisher $mockMetroPublisher */
        $mockMetroPublisher = $this->getMockMetroPublisher($mockHttpClient);
        $mockMetroPublisher->patch('/', ['name' => 'john doe'], [], true);
    }

    public function testPostRequestsSendFieldsAsFormParams() {
        $mockHttpClient = $this->createMock(HttpClientInterface::class);
        $mockHttpClient->expects($this->exactly(1))
                       ->method('post')
                       ->with('/', ['form_params' => ['name' => 'john doe']])
                       ->willReturn($this->getMockHttpResponse());

        $mockHttpClient->expects($this->exactly(1))
                       ->method('getOptions')
                       ->willReturn([]);

        $mockMetroPublisher = new MetroPublisher(null, null, $mockHttpClient);
        $mockMetroPublisher->post('/', ['name' => 'john doe'], [], true);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockHttpResponse() {
        $mockStream = $this->createMock(StreamInterface::class);
        $mockStream->expects($this->once())
                   ->method('getContents')
                   ->willReturn('[]');

        $response = $this->createMock(ResponseInterface::class);
        $response->expects($this->once())
                 ->method('getBody')
                 ->willReturn($mockStream);

        // Set content type as json
        $response->expects($this->once())
                 ->method('getHeader')
                 ->with('Content-Type')
                 ->willReturn('application/json');

        // Return 200 status code
        $response->expects($this->once())
                 ->method('getStatusCode')
                 ->willReturn(200);

        return $response;
    }

    /**
     * @param $mockHttpClient
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|HttpClientInterface
     */
    private function getMockMetroPublisher($mockHttpClient) {
        $mockMetroPublisher = $this->getMockBuilder(MetroPublisher::class)
                              ->setConstructorArgs([null, null, $mockHttpClient])
                              ->setMethods(['parseResponseContent'])
                              ->getMock();

        $mockMetroPublisher->method('parseResponseContent')
                      ->willReturn(null);

        return $mockMetroPublisher;
    }
}