<?php
namespace MetroPublisher\Http;

use GuzzleHttp\Exception\ClientException;
use \InvalidArgumentException;
use MetroPublisher\Http\Response\ResponseMediator;
use MetroPublisher\Http\Steps\HttpStepInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package MetroPublisher\Http
 *
 * @method array get($endpoint, array $fields = [], array $options = [])
 * @method array put($endpoint, array $fields = [], array $options = [])
 * @method array post($endpoint, array $fields = [], array $options = [])
 * @method array patch($endpoint, array $fields = [], array $options = [])
 * @method array delete($endpoint, array $fields = [], array $options = [])
 */
class Client
{
    /** @var  array */
    protected $steps;

    /** @var  HttpClientInterface */
    private $httpClient;

    private static $httpMethods = ['get', 'post', 'put', 'patch', 'delete'];

    /**
     * Client constructor.
     *
     * @param HttpClientInterface $client
     * @param array               $steps
     */
    public function __construct(HttpClientInterface $client, array $steps = [])
    {
        $this->httpClient = $client;
        $this->steps      = $steps;
    }

    /**
     * @param $method
     * @param $arguments
     *
     * @return array
     */
    public function __call($method, $arguments)
    {
        if(!in_array($method, self::$httpMethods)) {
            throw new \BadMethodCallException(sprintf(
                'Class %s does not contain method %s.',
                    get_class($this),
                    $method));
        }

        if(count($arguments) < 1) {
            throw new InvalidArgumentException(vprintf("Method %s::%s requires 1 parameter, %s given.", [
                get_class($this),
                $method,
                count($arguments)
            ]));
        }

        // @todo - Add validation for these fields?
        $endpoint   = $arguments[0];
        $fields     = (isset($arguments[1])) ? $arguments[1] : [];
        $options    = (isset($arguments[2])) ? $arguments[2] : [];

        return $this->execute($method, $endpoint, $fields, $options);
    }

    /**
     *
     * @param       $method
     * @param       $endpoint
     * @param array $fields
     * @param array $options
     *
     * @return array|mixed
     */
    public function execute($method, $endpoint, array $fields = [], array $options = []) {
        unset($options['json'], $options['query']);

        if($method == 'get') {
            $options['query'] = $fields;
        } elseif($method == 'put' || $method == 'patch') {
            $options['json'] = $fields;
        } else {
            $options['form_params'] = $fields;
        }

        $options = array_merge($options, $this->getOptions());

        try {
            $response = call_user_func_array([$this->httpClient, $method], [$endpoint, $options]);
        } catch(ClientException $e) {
            $response = $e->getResponse();
        }

        $response = $this->executeResponseMiddleware($response);
        return $this->parseResponseContent($response);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    protected function executeResponseMiddleware(ResponseInterface $response) {
        /** @var HttpStepInterface $step */
        foreach($this->steps as $step) {
            $response = $step->handle($response);
        }

        return $response;
    }

    /**
     * @param ResponseInterface $response
     * @return array|mixed
     */
    protected function parseResponseContent(ResponseInterface $response) {
        return ResponseMediator::getContent($response);
    }

    /**
     * @param $class
     */
    public function addStep($class) {
        $this->steps[] = $class;
    }

    /**
     * @param $class
     */
    public function removeStep($class) {
        foreach($this->steps as $key => $step) {
            if($class == $step) {
                unset($this->steps[$key]);
            }
        }
    }

    /**
     * @return array
     */
    public function getOptions() {
        $options = $this->httpClient->getOptions();
        return (is_array($options)) ? $options : [];
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->httpClient->setOptions($options);
    }
}