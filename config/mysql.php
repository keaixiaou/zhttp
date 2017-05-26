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
            'host' => '111.202.121.211',
            'port' => 3306,
            'user' => 'xinglong',
            'password' => '1qaz2wsx',
            'database' => 'dbmain',
            'charset' => 'utf8',
            'asyn_max_count' => 2,
            'start_count' => 2,
        ],
    ],

];
