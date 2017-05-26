<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2016/12/19
 * Time: 下午6:29
 */

namespace model;
use ZPHP\Core\Db;

class Test{
    public function getUserById($id){
        $data = yield table('user')->where(['id'=>$id])->find();
        return $data;
    }


    public function getUserByIds($id){
        $data = yield table('user')->where(['id'=>$id])->find();
        return json_encode($data);
    }

    public function test($key){
        $data = yield Db::redis()->cache($key);
        return $data;
    }

    public function getUserDetail($id, $name){
        $user = yield Db::table('user')->where(['id'=>$id])->find();
        return ['user'=>$user,'id'=> $id, 'name'=>$name];
    }


    public function insert($time, $name){
        $id = yield Db::table('vt_time')->add(['time'=>$time,'name'=>$name]);
        return $id;
    }




}