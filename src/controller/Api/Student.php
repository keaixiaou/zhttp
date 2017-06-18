<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2017/3/24
 * Time: 下午3:11
 */

namespace controller\Api;

use ZPHP\Controller\Controller;

class Student extends Controller{

    /**
     * @method POST
     * @description  student-index
     * @param Int $a  用户编号 optional
     * @param Int $b 用户名称
     * @param String $c 用户性别
     * @return Int $a 用户编号
     * @return Int $b 用户昵称
     *
     */
    public function index(){
       return "student";
    }

    /**
     * @method POST
     * @description  处理学生加入结果
     * @param Int $b 用户名称
     * @param Int $a  用户编号 optional
     * @param String $c 用户性别
     * @return Bool $res 处理结果
     *
     */
    public function joinClass(){
        $this->jsonReturn(['res'=>true]);
    }
}