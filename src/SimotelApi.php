<?php

namespace Hsy\Simotel;


use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class SimotelApi
{
    private $message = "";
    private $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function addToQueue($queue, $source, $agent, $penalty = 0)
    {
        $query = "queue/add/?queue={$queue}&source={$source}&agent={$agent}&penalty={$penalty}";
        return $this->call($query);
    }

    public function removeFromQueue($queue, $agent)
    {
        $query = "/queue/remove/?queue={$queue}&agent={$agent}";
        return $this->call($query);
    }

    public function pauseInQueue($queue, $agent)
    {
        $query = "/queue/pause/?queue={$queue}&agent={$agent}";
        return $this->call($query);
    }

    public function resumeInQueue($queue, $agent)
    {
        $query = "/queue/resume/?queue={$queue}&agent={$agent}";
        return $this->call($query);
    }


    public function pbxUsersSearch($data=[])
    {
        $default = [
            "status" => "all",
            "alike" => 1,
            "conditions" => [
                "name" => "",
                "number" => "",
                "mapped" => ""
            ]
        ];

        $data = array_merge($default,$data);

        $this->call($uri,$data);
    }

    private function call($query)
    {
        $options = [
            "auth" =>
                [
                    $this->config["user"] ?? "", //basic auth username
                    $this->config["pass"] ?? ""  //basic auth password
                ]
        ];
        $apiServer = $this->config["serverAddress"];
        $requestMethod = $this->config["requestMethod"] ?? "POST";

        try {
            // Create a client with a base URI
            $client = new Client(['base_uri' => $apiServer]);
            $response = $client->request($requestMethod, $query, $options);
            var_dump($response->getBody());

        } catch (\Exception $e) {
            var_dump($e->getMessage());
            $this->message = $e->getMessage();
            return false;
        }

    }
}
