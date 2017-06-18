<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 16/9/22
 * Time: 下午3:03
 */


return [
    'redis' => [
        'ip' => '127.0.0.1',
        'port' => 6602,
//        'select' => 0,
//        'password' => '123456',
        'asyn_max_count' => 10,
        'start_count' => 0,
        'max_onetime_task' => 10000,
    ],
];
