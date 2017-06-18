<?php

use \ZPHP\Socket\Adapter\Swoole;

return [
    'project'=>[

        'project_name' => 'zhttp',
        'app_path' => 'src',
        'pid_path'  => ROOTPATH.'/bin',
        'doc_path' => 'doc',
        'ctrl_path' => 'controller',
        'common_file'  => ROOTPATH.'/library/function.php',
        'swoole_module' => [
//        'test'=>ROOTPATH.'/extension/test.so'
        ],


        'name'=>'zhttp',
        'view'=> [
            'tag'=>true,
        ],

        'mvc'  => [
            'module'=>'Home',
            'controller' => 'Index',
            'action' => 'index'
        ],
        'timeout' => 15000,
        'reload' => DEBUG,
    ]
];
