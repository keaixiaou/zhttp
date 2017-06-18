<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/5/27
 * Time: 下午4:47
 */

return [
    'session' => [
        'enable' => false,
        'adapter' => 'File',
        'path' => ROOTPATH.'/tmp/session',
        'redis' => [
            'ip' => '127.0.0.1',
            'port' => 6379,
            'select' => 1,
            'password' => '123456',
            'asyn_max_count' => 10,
            'start_count' => 5,
        ],
        'name' => 'sses_',
        'session_name'=>'ZPHP_SID',
        'cache_expire' => 3600,
    ],
];