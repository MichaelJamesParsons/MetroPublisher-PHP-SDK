<?php
namespace MetroPublisher\Http;

use \InvalidArgumentException;
use GuzzleHttp\Client as Guzzle;
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
class Client implements HttpClientInterface
{
    /** @var  array */
    protected $defaultOptions;

    /** @var  array */
    protected $steps;

    /** @var  Client */
    private $client;

    private static $httpMethods = ['get', 'post', 'put', 'patch', 'delete'];

    /**
     * Client constructor.
     *
     * @param array $options
     * @param array $steps
     */
    public function __construct(array $options = [], array $steps = [])
    {
        $this->client = new Guzzle($options);
        $this->steps  = $steps;
        $this->defaultOptions = [];
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
            throw new \BadMethodCallException(sprintf('Class %s does not have method "%s"', $method));
        }

        if(count($arguments) < 1) {
            throw new InvalidArgumentException(vprintf("Method %s::%s requires 1 parameter, %s given.", [
                get_class($this),
                $method,
                count($arguments)
            ]));
        }

        $endpoint   = (isset($arguments[0])) ? $arguments[0] : [];
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
     * @return array
     */
    public function execute($method, $endpoint, array $fields = [], array $options = []) {
        unset($options['json'], $options['query']);

        if($method == 'get') {
            $options['query'] = $fields;
        } else {
            $options['form_params'] = $fields;
        }

        $options = array_merge($options, $this->getDefaultOptions());

        $response = call_user_func_array([$this->client, $method], [$endpoint, $options]);
        return $this->handleResponse($response);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return array
     */
    public function handleResponse(ResponseInterface $response) {
        /** @var HttpStepInterface $step */
        foreach($this->steps as $step) {
            $response = $step->handle($response);
        }

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
    public function getDefaultOptions() {
        return $this->defaultOptions;
    }

    /**
     * @param array $options
     */
    public function setDefaultOptions(array $options)
    {
        $this->defaultOptions = $options;
    }
}