<?php

namespace Hsy\Simotel\Tests;

use Hsy\Simotel\Simotel;

class SimotelApiTest extends TestCase
{


    public function testAddQueue()
    {
        $simotel = new Simotel();
        $response = $simotel->connect()->pbx()->users()->add("user-name","200","secret");
        var_dump($response);
    }
}
