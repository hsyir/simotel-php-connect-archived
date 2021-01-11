<?php


namespace Hsy\Simotel\SimotelApi;


class Response
{
    public $success, $message, $data;

    public function __construct($guzzleResponse)
    {
        $responseBodyContent = json_decode($guzzleResponse->getBody()->getContents());
        $this->success = $responseBodyContent->success;
        $this->message = $responseBodyContent->message;
        $this->data = $responseBodyContent->data;
    }
}