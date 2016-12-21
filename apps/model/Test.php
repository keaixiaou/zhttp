<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2016/12/19
 * Time: 下午6:29
 */

namespace model;
class Test{
    public function getUserById($id){
        return table('user')->where(['id'=>$id])->find();
    }
}