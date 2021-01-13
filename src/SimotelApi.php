<?php

namespace Hsy\Simotel;

use Hsy\Simotel\SimotelApi\ApiGroups\Autodialer;
use Hsy\Simotel\SimotelApi\ApiGroups\Call;
use Hsy\Simotel\SimotelApi\ApiGroups\Pbx;
use Hsy\Simotel\SimotelApi\ApiGroups\Reports;
use Hsy\Simotel\SimotelApi\ApiGroups\Voicemails;
use Hsy\Simotel\SimotelApi\BaseApiGroups;

class SimotelApi
{
    /*  private $message = '';*/
    private $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function __call($name, $arguments)
    {
        $groupClasses = ["pbx", "autodialer", "call", "reports", "voicemails"];
        if (!in_array($name, $groupClasses))
            throw new \Exception("api group class not found: '$name'");

        return $this->makeApiGroupClass($name, $this->config);
    }

    private function makeApiGroupClass($name, $config)
    {
        return new class (ucfirst($name), $config) extends BaseApiGroups {
            protected $namespace;

            public function __construct($name, array $config = [])
            {
                $this->namespace = "\\Hsy\\Simotel\\SimotelApi\\ApiGroups\\$name\\";
                parent::__construct($config);
            }
        };
    }
}
