<?php


namespace Hsy\Simotel\SimotelApi;


use GuzzleHttp\Client;
use Hsy\Simotel\Simotel;

class SimotelApiCenter extends Simotel
{
    protected $config;

    public function __construct(array $config = null)
    {
        $this->setConfig($config);
        parent::__construct($this->config);
    }

    public function setConfig(array $config = null)
    {
        $this->config = $config ?: $this->loadDefaultConfig()["simotelApi"];
    }

    public function makeHttpRequestOptions()
    {
        return [
            'auth' => [
                $this->config["connect"]['user'] ?? '', //basic auth username
                $this->config["connect"]['pass'] ?? '',  //basic auth password
            ],
            'headers' => [
                'X-APIKEY' => $this->config["connect"]['token'],
            ],
        ];
    }

    protected function sendRequest($uri, $requestBody = [], $method = "POST")
    {
        $options = $this->makeHttpRequestOptions();
        $options["json"] = $requestBody;

        try {
            $client = $this->makeHttpClient();
            $response = $client->request($method, $uri, $options);
            return $response->getBody()->getContents();

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    protected function makeHttpClient()
    {
        return new Client([
            'base_uri' => $this->config["connect"]['server_address']
        ]);
    }


    public function __call($methodName, $arguments)
    {
        $parameters = $arguments[0];

        $userDataInput = $parameters instanceof Parameters ? $parameters->toArray() : $parameters;

        $apiDataMaker = new ApiRequestDataMaker($this->config["methods"][$this->makeConfigKey($methodName)], $methodName, $userDataInput);

        $this->sendRequest($apiDataMaker->uri, $apiDataMaker->data, $apiDataMaker->requestMethod);
    }


    protected function makeConfigKey($methodName)
    {
        return $this->apiAddressConfigPrefix . $methodName;
    }
}