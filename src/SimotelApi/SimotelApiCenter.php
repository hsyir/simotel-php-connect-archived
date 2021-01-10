<?php


namespace Hsy\Simotel\SimotelApi;


use GuzzleHttp\Client;

class SimotelApiCenter
{
    protected $config;

    public function __construct(array $config = [])
    {
        $this->setConfig($config);
    }

    public function setConfig(array $config)
    {
        $this->config = $config;
    }


    public function getOptions()
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

    protected function call($uri, $requestBody = [], $method = "POST")
    {
        $options = $this->getOptions();
        $options["json"] = $requestBody;
        try {
            // Create a client with a base URI
            $client = $this->getHttpClient();
            $response = $client->request($method, $uri, $options);
            return $response->getBody()->getContents();

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    protected function getHttpClient()
    {
        return new Client([
            'base_uri' => $this->config["connect"]['serverAddress']
        ]);
    }

}