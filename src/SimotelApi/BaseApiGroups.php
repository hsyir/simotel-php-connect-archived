<?php


namespace Hsy\Simotel\SimotelApi;


class BaseApiGroups
{
    private $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function __call($name, $arguments)
    {

        $className = $this->namespace . ucfirst($name)  ;
        var_dump($className);
        if(class_exists($className))
            return new $className($this->config);
        else
            throw new \Exception("class $name not found");
    }
}