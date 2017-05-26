<?php

use \ZPHP\Socket\Adapter\Swoole;

return array(
    'server_mode' => 'Socket',
    'project_name' => 'zhttp',
    'app_path' => 'src',
    'doc_path' => 'doc',
    'ctrl_path' => 'controller',
    'common_file'  => '/library/function.php',
    'swoole_module' => [
//        'test'=>ROOTPATH.'/extension/test.so'
    ],
    'socket' => array(
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
    ),
    'session'=> array(
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
    ),

    'cookie'=> array(
        'enable' => false,
        'cache_expire' => 86400,
    ),

    'project'=>array(
        'name'=>'zhttp',
        'view'=> [
            'tag'=>true,
        ],
        'pid_path'  => ROOTPATH.'/bin',
        'mvc'  => [
            'module'=>'Home',
            'controller' => 'Index',
            'action' => 'index'
        ],
        'timeout' => 15000,
        'reload' => DEBUG,
    ),

    'websocket' => [
        'parse' =>[
            'module'=>'Home',
            'controller' => 'Index',
            'action' => 'index',
            'field' => [
                'data' => 'd',
                'route' => 'm',
            ],
            'route' => [
                'login'=>'Index/index',
            ],
        ],
    ],

);
