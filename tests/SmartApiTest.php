<?php


namespace Hsy\Simotel\Tests;


use Hsy\Simotel\Simotel;
use Hsy\Simotel\SmartApiCommands;

class SmartApiTest extends TestCase
{
    private $config = [
        "smartApi" => [
            "appClasses" => [
                "fooApp" => FooSmartApi::class,
                "*" => RestOfApps::class,
            ]
        ]
    ];


    public function testResponse()
    {
        $appData = [
            "app_name" => "fooApp",
            "data" => "foo"
        ];

        $simotel = new Simotel($this->config);
        $response = $simotel->smartApiCall($appData);

        $this->assertJson($response->toJson());

        $response=$response->toArray();
        $this->assertIsArray($response);
        $this->assertArrayHasKey("commands", $response);
        $this->assertArrayHasKey("ok", $response);

    }


    public function testNoOkResponse()
    {
        $appData = [
            "app_name" => "barApp",
        ];

        $simotel = new Simotel($this->config);
        $response = $simotel->smartApiCall($appData)->toArray();
        var_dump($response);
        $this->assertEquals(["ok"=>0],$response);

    }


    public function testCommands()
    {

    }
}

class FooSmartApi
{
    use SmartApiCommands;

    public function fooApp()
    {
        $this->cmdExit(1);
        return $this->okResponse();
    }
}

class RestOfApps
{
    use SmartApiCommands;

    public function barApp()
    {
        return $this->errorResponse();
    }


}