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
        $this->assign('data','Hello zhttp');
        $this->display();

    }


    public function test(){

        if(empty($_SESSION['user'])){
            $_SESSION['user'] = yield table('admin_user')->where(['id'=>1])->find();
        }
        $this->display();
    }
}