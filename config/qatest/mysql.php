<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2017/2/10
 * Time: 下午4:51
 */

return [
    'mysql'=>[
        'default' =>[
            'host' => '120.27.143.217',
            'port' => 3306,
            'user' => 'jeekzx',
            'password' => '7f331f',
            'database' => 'test',
            'charset' => 'utf8', //指定字符集
            'asyn_max_count' => 10,
            'start_count' => 0,
            'max_onetime_task' => 1000,
        ],

        'read' => [
            'host' => '127.0.0.1',
            'port' => 3306,
            'user' => 'test',
            'password' => 'test',
            'database' => 'test',
            'charset' => 'utf8', //指定字符集
            'asyn_max_count' => 10,
            'start_count' => 0,
            'max_onetime_task' => 1000,
        ],
    ],

];
