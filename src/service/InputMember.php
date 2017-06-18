<?php
/**
 * Created by PhpStorm.
 * User: zhuhe
 * Date: 17/5/21
 * Time: 下午1:31
 */

namespace service;


use ZPHP\Client\SwoolePid;
use ZPHP\Core\App;
use ZPHP\Core\Config;
use ZPHP\Core\DI;
use ZPHP\Core\Db;
use ZPHP\Core\Log;


class InputMember
{

    public function index(){
        //Config::
//        $db = Config::getField('dbset','member');
        Log::write('InputMember');
        $data = 'InputMember';
//        $data = yield Db::table('common_member')->where(array('id',array('gt',0)))->limit(10);
        return $data;
//        App::init(DI::getInstance());
//        //while(true){
//        $data = App::model("APP#inputMember")->getMember(10,0);
//        if($data == false){
//            $list = SwoolePid::makePidList('InputMember', 'input', 0);
//            SwoolePid::putPidList($list);
//            //break;
//        }
//        //}
//        return $data;
    }
}