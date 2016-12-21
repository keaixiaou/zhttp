<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2016/12/19
 * Time: 下午5:49
 */

return [    'route'=>
    [
        'ANY' => [
            '/Test/{id}' => function($id){
                return \ZPHP\Core\App::controller('Home\Index')->index($id);
            },
        ],
    ],
];