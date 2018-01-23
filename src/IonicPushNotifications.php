<?php namespace Zehntinel\IonicApiPhp;


/**
 * Ionic-API-PHP : Simple PHP Wrapper for Ionic Cloud API
 *
 * PHP version 7.0
 *
 * @category Awesomeness
 * @package  Ionic-API-PHP
 * @author   Adrian Galicia <adgaben@gmail.com>
 * @license  MIT License
 * @version  0.0.1
 * @link
 */

use GuzzleHttp\Client;
use SebastianBergmann\Exporter\Exception;

class IonicPushNotifications
{

    /**
     * @var string
     */
    private $baseUri = "https://api.ionic.io/";

    /**
     * @var array
     */
    private $requestBody;

    /**
     * @var string
     */
    private $requestMethod;

    /**
     * @var string
     */
    private $requestUri;

    /**
     * @var int
     */
    private $requestStatusCode;

    /**
     * @var string
     */
    private $requestStatusReason;

    /**
     * @var string
     */
    private $requestBodyContent;

    /**
     * @var mixed
     */
    private $client;

    /**
     *  Create the API access object an (string) Ionic Cloud API KEY.
     *
     * @param string $apiKey
     */

    public function __construct($apiKey)
    {
        $this->client = new Client([
            'base_uri' => $this->baseUri,
            'headers' => [
                "Authorization" => "Bearer " . $apiKey,
                "Content-Type" => "application/json"
            ]
        ]);
    }


    /**
     * Set postfields array, example: array('message' => 'Hola Mundo!')
     *
     * @param array $requestBody Array of parameters to send to API
     *
     * @throws \Exception When array is not an array
     *
     * @return IonicPushNotifications Instance of self for method chaining
     */
    public function setRequestBody(array $requestBody)
    {
        $this->requestBody = ['body'=>json_encode($requestBody)];
        return $this;
    }

    /**
     * Set request method string, example : "POST","GET","PUT","PATCH"
     *
     * @param $requestMethod
     *
     * @return IonicPushNotifications Instance of self for method chaining
     */
    public function setRequestMethod($requestMethod)
    {
        $this->requestMethod = $requestMethod;

        return $this;
    }

    /**
     * Set request URI string, example : "/get/example/data"
     *
     * @param $requestUri
     *
     * @return IonicPushNotifications Instance of self for method chaining
     */
    public function setRequestUri($requestUri)
    {
        $this->requestUri = $requestUri;

        return $this;
    }

    /**
     * Get Http Request Status Code
     *
     * @return int
     */
    public function getRequestStatusCode()
    {
        return $this->requestStatusCode;
    }

    /**
     * Get Http Request Reason
     *
     * @return string
     */
    public function getStatusReason()
    {
        return $this->requestStatusReason;
    }

    /**
     * Get Performed Request Body Content
     *
     * @return string
     */
    public function getRequestBodyContent()
    {
        return $this->requestBodyContent;
    }

    /**
     * Perform the actual data retrieval from the API
     *
     * @param boolean $return If true, returns data. This is left in for backward compatibility reasons
     *
     * @throws \Exception
     *
     * @return string json If $return param is true, returns json data.
     */
    public function performRequest($return = true)
    {
        $response = $this->client->request($this->requestMethod,$this->requestUri,$this->requestBody);

        $this->requestStatusCode = $response->getStatusCode();
        $this->requestStatusReason = $response->getReasonPhrase();
        $this->requestBodyContent = $response->getBody();

        return $response;
    }

}