<?php
namespace MetroPublisher;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use http\Exception\InvalidArgumentException;
use MetroPublisher\Http\ConnectionException;
use MetroPublisher\Http\HttpClientInterface;
use MetroPublisher\Http\Guzzle\GuzzleAdapter;
use MetroPublisher\Http\Response\ResponseMediator;
use MetroPublisher\Http\Steps\HttpResponseExceptionThrower;
use MetroPublisher\Http\Steps\HttpStepInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class MetroPublisher
 * @package MetroPublisher
 *
 * @method array get($endpoint, array $fields = [], array $options = [], $disableAuth = false)
 * @method array put($endpoint, array $fields = [], array $options = [], $disableAuth = false)
 * @method array post($endpoint, array $fields = [], array $options = [], $disableAuth = false)
 * @method array patch($endpoint, array $fields = [], array $options = [], $disableAuth = false)
 * @method array delete($endpoint, array $fields = [], array $options = [], $disableAuth = false)
 */
class MetroPublisher
{
    /** @var  string */
    private $apiKey;

    /** @var  string */
    private $secretKey;

    /** @var  string */
    private $bearer;

    /** @var  int */
    private $accountId;

    /** @var HttpClientInterface */
    private $httpClient;

    /** @var  HttpStepInterface[] */
    private $responseMiddleware;

    /** @var array */
    private static $httpMethods = ['get', 'post', 'put', 'patch', 'delete'];

    const API_BASE = "https://api.metropublisher.com";
    const O_AUTH_BASE = "https://go.metropublisher.com";

    /**
     * MetroPublisher constructor.
     *
     * @param string              $key          - MetroPublisher public API key.
     * @param string              $secret       - MetroPublisher secret API key.
     * @param HttpClientInterface $httpClient   - Http client to handle API requests.
     */
    public function __construct($key, $secret, HttpClientInterface $httpClient = null)
    {
        $this->apiKey = $key;
        $this->secretKey = $secret;
        $this->responseMiddleware = [new HttpResponseExceptionThrower()];

        if ($httpClient !== null) {
            $this->httpClient = $httpClient;
        } else {
            $this->httpClient = new GuzzleAdapter(new Client());
        }
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
        $endpoint    = $arguments[0];
        $fields      = (isset($arguments[1])) ? $arguments[1] : [];
        $options     = (isset($arguments[2])) ? $arguments[2] : [];
        $disableAuth = (isset($arguments[3]) && $arguments[3]);

        if (!$disableAuth) {
            $this->connect();
        }

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
    private function execute($method, $endpoint, array $fields = [], array $options = []) {
        unset($options['json'], $options['query']);

        if($method == 'get') {
            $options['query'] = $fields;
        } elseif($method == 'put' || $method == 'patch') {
            $options['json'] = $fields;
        } else {
            $options['form_params'] = $fields;
        }

        $options = array_merge($options, $this->httpClient->getOptions());

        try {
            $response = call_user_func_array([$this->httpClient, $method], [$endpoint, $options]);
        } catch(ClientException $e) {
            $response = $e->getResponse();
        }

        $response = $this->executeResponseMiddleware($response);
        return $this->parseResponseContent($response);
    }

    /**
     * Fetches OAuth token from MetroPublisher.
     *
     * @link https://api.metropublisher.com/narr/design.html#authentication
     *
     * @throws ConnectionException
     */
    private function connect() {
        try {
            if ($this->isAuthenticated()) {
                return;
            }

            $this->httpClient->setBaseUri(MetroPublisher::O_AUTH_BASE);
            $response = $this->post('/oauth/token', [
                    "grant_type" => "client_credentials",
                    "api_key"    => $this->apiKey,
                    "api_secret" => $this->secretKey
            ], [], true);

            $this->accountId = $response['items'][0]['id'];
            $this->bearer    = $response['access_token'];

            // Add default authorization header to HTTP client
            $clientConfig = $this->httpClient->getOptions();
            $clientConfig['headers']['Authorization'] = "Bearer {$this->bearer}";
            $this->httpClient->setOptions($clientConfig);
            $this->httpClient->setBaseUri(MetroPublisher::API_BASE . "/{$this->accountId}");
            $this->httpClient->setDefaultContentType("application/json; charset=UTF-8");
        } catch(\Exception $e) {
            throw new ConnectionException("Failed to fetch bearer. Please check API credentials.", $e->getCode(), $e);
        }
    }

    /**
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    private function executeResponseMiddleware(ResponseInterface $response) {
        /** @var HttpStepInterface $step */
        foreach($this->responseMiddleware as $step) {
            $response = $step->handle($response);
        }

        return $response;
    }

    /**
     * @param ResponseInterface $response
     * @return array|string
     */
    private function parseResponseContent(ResponseInterface $response) {
        return ResponseMediator::getContent($response);
    }

    /**
     * Returns true if both an account ID and authentication token have
     * been fetched from the auth API.
     *
     * @return bool
     */
    private function isAuthenticated() {
        return !empty($this->accountId) && !empty($this->bearer);
    }

    /**
     * @return HttpClientInterface
     */
    public function getHttpClient() {
        return $this->httpClient;
    }
}