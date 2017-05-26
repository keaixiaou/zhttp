<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 16/7/17
 * Time: 下午1:48
 */

namespace service;

use ZPHP\Core\Log;

class Test{
    /**
     * 普通例子,非task
     * @return mixed
     */
    public function test(){
        $sql = 'select * from admin_user where id=1';
        $data['sql'] = $sql;
        $data['info'] = yield table('admin_user')->where(['id'=>1])->find();
        return $data;
    }


    /**
     * task示例
     * @param $data
     * @return string
     */
    public function task($data){
        sleep(1);
        Log::write('task'.$data);
        return 'task'.$data;
    }

}