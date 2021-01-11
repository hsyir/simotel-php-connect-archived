<?php

namespace Hsy\Simotel\Tests;

use GuzzleHttp\Client;
use Hsy\Simotel\Simotel;
use Hsy\Simotel\SimotelApi\Parameters;
use Hsy\Simotel\SimotelApi\Pbx\Users;

class SimotelApiTest extends TestCase
{
    public function testAddQueue()
    {
        $parameters = new Parameters;
        $parameters->name = "test name";
        $parameters->number = "1000";
        $parameters->secret = "secret";

        $users = new \Hsy\Simotel\SimotelApi\Pbx\Users();
        $users->create($parameters);

        $simotel = new Simotel();
        $simotel->connect()->pbx()->users()->create($parameters);
    }
}
