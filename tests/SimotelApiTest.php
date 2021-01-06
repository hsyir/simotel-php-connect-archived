<?php


namespace Hsy\Simotel\Tests;


use Hsy\Simotel\Simotel;
use Hsy\Simotel\SmartApiCommands;

class SimotelApiTest extends TestCase
{
    private $config = [
        "simotelApi" => [
            "user" => "hsy",
            "pass" => "hsy",
            "requestMethod" => "POST",
            "serverAddress" => "http://37.156.144.147/api/v1/",
        ]
    ];

    public function testAddQueue()
    {
        $simotel = new Simotel($this->config);
        $simotel->connect()->addToQueue("202", "202", "200");
    }
}