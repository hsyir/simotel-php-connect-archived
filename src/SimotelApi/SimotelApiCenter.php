<?php


namespace Hsy\Simotel\SimotelApi;


use GuzzleHttp\Client;

class SimotelApiCenter
{
    protected $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    protected function call($uri, $data, $method = "POST")
    {

        $options = [
            'auth' => [
                $this->config["connect"]['user'] ?? '', //basic auth username
                $this->config["connect"]['pass'] ?? '',  //basic auth password
            ],
            'headers' => [
                'X-APIKEY' => "7c26y2qfWIsw09kMVvf6dSu8Oc0hvBEdlWI469FWguaLOBZoBn"
            ],
            "json" => $data
        ];

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