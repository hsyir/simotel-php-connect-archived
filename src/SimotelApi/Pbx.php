<?php


namespace Hsy\Simotel\SimotelApi;


use Hsy\Simotel\SimotelApi\Pbx\Users;

class Pbx
{
    private $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function users()
    {
        return new Users($this->config);
    }
}