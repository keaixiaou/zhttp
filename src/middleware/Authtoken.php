<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2017/3/23
 * Time: 下午4:38
 */

namespace middleware;

use ZPHP\Core\Db;

class Authtoken{
    public function check($token){
        $res = yield Db::redis()->cache($token);
        return !empty($res)?true:false;
    }
}