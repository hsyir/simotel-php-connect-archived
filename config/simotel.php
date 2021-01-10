<?php

return [
    'smartApi' => [
        'apps' => [
            '*' => "\App\Simotel\SmartApiApps",
        ],
    ],
    'simotelApi' => [
        "connect" => [
            'user' => 'hsy',
            'pass' => 'asd123ASD',
            'token' => "7c26y2qfWIsw09kMVvf6dSu8Oc0hvBEdlWI469FWguaLOBZoBn",
            'serverAddress' => 'http://37.156.144.147/api/v3/',
        ],
        "defaults" => [
            "pbx" => [
                "users" => [
                    "add" =>
                        [
                            'user_type' => 'SIP',
                            'active' => 'yes',
//                            'name' => '',
//                            'number' => '',
                            'cid_number' => '',
//                            'secret' => '',
                            'call_record' => 'no',
                            'push_notification' => 'no',
                            'deny' => '0.0.0.0/0.0.0.0',
                            'permit' => '0.0.0.0/0.0.0.0',
                            'dtmfmode' => 'rfc2833',
                            'canreinvite' => 'no',
                            'directmedia' => 'no',
                            'context' => 'main_routing',
                            'host' => 'dynamic',
                            'type' => 'user',
                            'nat' => 'no',
                            'port' => '5060',
                            'qualify' => 'no',
                            'callgroup' => '1',
                            'pickupgroup' => '1',
                            'callcounter' => 'no',
                            'faxdetect' => 'no',
                            'call_limit' => '',
                            'trunk' => 'no',
                            'transfer' => 'no',
                            'email' => '',
                            'forward_policy' =>
                                [
                                    'Busy' => '',
                                    'No Answer' => '',
                                    'UnAvailable' => '',
                                    'All' => '',
                                ],
                            'more_options' => '',
                        ]
                ]
            ]
        ]


    ],

];
