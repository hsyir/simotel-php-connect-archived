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

    /**
     * @param $name
     * @param $arguments
     * @return __anonymous|BaseApiGroups|__anonymous@1023
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        $name = ucfirst($name);
        $groupClasses = ["Pbx", "Autodialer", "Call", "Reports", "Voicemails"];

        if (!in_array($name, $groupClasses))
            throw new \Exception("api group class not found: '{$name}'");

        return $this->makeApiGroupClass($name, $this->config);
    }

    /**
     * @param $className
     * @param $config
     * @return BaseApiGroups|__anonymous@923
     */
    private function makeApiGroupClass($className, $config)
    {
        return new class ($className, $config) extends BaseApiGroups {

            protected $namespace;

            public function __construct($className, array $config = [])
            {
                $this->namespace = "\\Hsy\\Simotel\\SimotelApi\\ApiGroups\\$className\\";
                parent::__construct($config);
            }
        };
    }
}
