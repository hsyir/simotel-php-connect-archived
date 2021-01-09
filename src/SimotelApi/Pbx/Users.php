<?php


namespace Hsy\Simotel\SimotelApi\Pbx;


use Hsy\Simotel\SimotelApi\SimotelApiCenter;

class Users extends SimotelApiCenter
{
    public function add(string $name, string $number, string $secret)
    {
        $data = $this->getMergedRequestBody(
            compact("name", "number", "secret"),
            $this->getDefaultRequestBody("add")
        );

        return $this->call(
            "pbx/users/add",
            $data
        );
    }


    private function getDefaultRequestBody(string $method)
    {
        return $this->config["defaults"]["pbx"]['users'][$method] ?? [];
    }

    private function getMergedRequestBody(array $inputs, array $defaultRequestBody)
    {
        return array_merge($inputs, $defaultRequestBody);
    }
}