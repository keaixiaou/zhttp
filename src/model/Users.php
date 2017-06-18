<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2017/4/22
 * Time: 下午11:30
 */
namespace model;

use ZPHP\Core\Db;

class Users{
    public function getUserInfoByPhone($phone)
    {
        $userInfo = yield Db::table('users')->where(['phone' => $phone])->find();
        return $userInfo;
    }
}