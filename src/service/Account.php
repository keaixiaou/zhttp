<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2017/4/22
 * Time: 下午11:29
 */

namespace service;

use ZPHP\Core\App;

class Account{
    public function loginByPwd($phone, $password)
    {
        if (empty($password)) {
            return 1012; // 密码不能为空
        }
        $userInfo = yield App::model('Users')->getUserInfoByPhone($phone);
        return $userInfo;

        // 这个地方userInfo 拿到的字段不全

        if (empty($userInfo)) { // 没有找到用户信息, 注册一个, 手机验证码登陆才能自动注册
            // $userInfo = self::regUserByPhone($phone, $password);
        }
        switch ($userInfo['status']) {
            case 1:
                // 验证密码
                if (md5($password.$userInfo['salt']) != $userInfo['password']) {
                    // 记录密码错误次数
                    self::logPwdError($phone);
                    return 1013; // 密码错误
                }
                self::login($userInfo);
                return 200;
                break;
            case 2:
                return 1010; // 当前用户处于禁用状态,无法登陆
                break;
            default:
                return 1000; // 非法操作
                break;
        }


    }
}