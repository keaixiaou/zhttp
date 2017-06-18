<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/5/27
 * Time: 下午4:50
 */

return [
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
];