<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 16/7/15
 * Time: 下午3:58
 */

namespace controllers\Home;

use service\TestService;
use ZPHP\Cache\Factory;
use ZPHP\Cache\ICache;
use ZPHP\Controller\ApiController;
use ZPHP\Controller\Controller;
use ZPHP\Core\Config;
use ZPHP\Core\Log;
use ZPHP\Core\Db;
use ZPHP\Coroutine\Http\HttpClientCoroutine;
use ZPHP\Db\Mongo;
use ZPHP\Manager\Redis;
use ZPHP\Model\Model;

class Index extends Controller{
    public function index(){
        if(!empty($_SESSION['user'])){
            $data = yield table('admin_user')->where(['id'=>1])->find();
            $_SESSION['user'] = $data['result'][0];
        }
        $this->display();
    }


    public function test(){
        $this->assign('data','hello zhttp');
        $this->display('home/index/test');
    }
}