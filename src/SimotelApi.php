<?php

namespace Hsy\Simotel;

use Hsy\Simotel\SimotelApi\ApiGroups\Autodialer;
use Hsy\Simotel\SimotelApi\ApiGroups\Call;
use Hsy\Simotel\SimotelApi\ApiGroups\Pbx;
use Hsy\Simotel\SimotelApi\ApiGroups\Reports;
use Hsy\Simotel\SimotelApi\ApiGroups\Voicemails;

class SimotelApi
{
    /*  private $message = '';*/
    private $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function pbx()
    {
        return new Pbx($this->config);
    }

    public function call()
    {
        return new Call($this->config);
    }

    public function voicemails()
    {
        return new Voicemails($this->config);
    }

    public function reports()
    {
        return new Reports($this->config);
    }

    public function autodialer()
    {
        return new Autodialer($this->config);
    }
}
