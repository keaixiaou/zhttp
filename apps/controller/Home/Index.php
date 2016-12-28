<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 16/7/15
 * Time: 下午3:58
 */

namespace controller\Home;

use service\TestService;
use ZPHP\Cache\Factory;
use ZPHP\Cache\ICache;
use ZPHP\Controller\ApiController;
use ZPHP\Controller\Controller;
use ZPHP\Core\App;
use ZPHP\Core\Config;
use ZPHP\Core\Log;
use ZPHP\Core\Db;
use ZPHP\Coroutine\Http\HttpClientCoroutine;
use ZPHP\Db\Mongo;
use ZPHP\Manager\Redis;
use ZPHP\Model\Model;

class Index extends Controller{
    public function index(){
        return 'Hello zhttp!';
    }


    public function test(){

        if(empty($this->input->session('user'))){
            $this->input->session['user'] = yield table('admin_user')->where(['id'=>1])->find();
        }
        $this->assign('session', $this->input->session());
        $this->display();
    }

    public function getTest(){
        $data = yield App::service('test')->fuck();
        $this->assign('data', $data);
        $this->setTemplate('home');
        $this->display('index');
    }


    public function mongo(){
        $finddata = yield Db::collection('test')->where(['likes'=>100])->find();
        $getdata = yield Db::collection('test')->where(['likes'=>100])->get();
        $this->jsonReturn([$finddata,$getdata]);
    }
}