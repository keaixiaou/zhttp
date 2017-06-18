<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/5/27
 * Time: 下午4:46
 */

use \ZPHP\Socket\Adapter\Swoole;
return [
    'server' => [
        'host' => '0.0.0.0',
        'port' => 8991,
        'adapter' => 'Swoole',
        'server_type' => Swoole::TYPE_WEBSOCKET ,
        'daemonize' => 1,
        'work_mode' => 3,
        'single_task_worker_num' => 1,
        'worker_num' => 2,
        'max_request' => 0,
        'debug_mode' => 1,
        'log_file' => ROOTPATH.'/tmp/log/swoole.log',
    ],
];