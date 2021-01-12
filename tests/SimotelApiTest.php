<?php

namespace Hsy\Simotel\Tests;

use GuzzleHttp\Client;
use Hsy\Simotel\Simotel;
use Hsy\Simotel\SimotelApi\Parameters;
use Hsy\Simotel\SimotelApi\Pbx\Users;

class SimotelApiTest extends TestCase
{
    private $simotel;

    public function __construct()
    {
        $this->simotel = new Simotel();
        parent::__construct();
    }

    public function testPbxUsers()
    {
        $number = "testNumber";

        $parameters = new Parameters;
        $parameters->name = "test name ";
        $parameters->number = "$number";
        $parameters->secret = "secret";

        $result = $this->simotel->connect()->pbx()->users()->create($parameters);
        $this->assertEquals(1, $result->success);

        $newName = "new name";

        $parameters = new Parameters;
        $parameters->id = "$number";
        $parameters->name = $newName;

        $result = $this->simotel->connect()->pbx()->users()->update($parameters);
        $this->assertEquals(1, $result->success);

        $parameters = new Parameters;
        $parameters->conditions = ["number" => "$number"];
        $parameters->alike = 1;

        $result = $this->simotel->connect()->pbx()->users()->search($parameters);
        $this->assertEquals(1, $result->success);
        $this->assertEquals($result->data[0]->name, $newName);

        $parameters = new Parameters;
        $parameters->id = "$number";

        $result = $this->simotel->connect()->pbx()->users()->remove($parameters);
        $this->assertEquals(1, $result->success);
    }
}
