<?php


namespace Hsy\Simotel\SimotelApi\ApiGroups\Pbx;

use GuzzleHttp\Client;
use Hsy\Simotel\SimotelApi\SimotelApiCenter;

class MusicOnHolds extends SimotelApiCenter
{
    protected $apiAddressConfigPrefix = "pbx_music_on_holds_";
}