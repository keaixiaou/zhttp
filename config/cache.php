<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 16/8/29
 * Time: 下午6:25
 */

return array(
    'cache'=>array(
        /*异步非阻塞这里的参数无效*/
        'adapter' => 'Redis',
        'pconnect' => true,
        'host' => '127.0.0.1',
        'port' => 6379,
        'timeout' => 0,
        'pconnect' => 1,
        'prefix' => 'zchat'
    )
);