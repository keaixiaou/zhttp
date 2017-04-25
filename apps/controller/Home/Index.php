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
use ZPHP\Controller\WSController;
use ZPHP\Core\App;
use ZPHP\Core\Config;
use ZPHP\Core\Log;
use ZPHP\Core\Db;
use ZPHP\Coroutine\Base\TaskDistribute;
use ZPHP\Coroutine\Http\HttpClientCoroutine;
use ZPHP\Db\Mongo;
use ZPHP\Manager\Redis;
use ZPHP\Model\Model;

class Index extends Controller{
    public function index(){
        return 'Hello zhttp!';
    }
    public function test(){
        if(empty($this->request->session('user'))){
            $this->request->session['user'] = yield table('admin_user')->where(['id'=>1])->find();
        }
        $this->assign('session', $this->request->session());
        $this->display();
    }
    public function getTest(){
        $data = yield App::service('test')->fuck();
        $this->assign('data', $data);
        $this->setTemplate('home');
        $this->display('index');
    }
    public function redis(){
        $data = yield Db::redis()->rpush('myqueue', '2222');
//        $data = json_decode($data, true);
        $this->assign('data', $data);
        $this->display('index/index');
    }
    public function myempty(){
        $data = [['nickname'=>'Sven!']];
        $this->assign('data', $data);
        $this->setTemplate('home');
        $this->display('index');
    }
    public function mysql(){
        $data = yield Db::table('admin_user')->where(['id'=>1])->get();
        $this->assign('data', $data);
        $this->setTemplate('home');
        $this->display('index');
    }
    public function mongo(){
        $key = ['num'=>1];
        $initial = ['all'=>0,'no'=>0,'finish'=>0];
        $reduce = "function(obj, prev){prev.all=prev.all+obj.num}";
//         $group = yield Db::collection('hello')->where(['like'=>['lte',5]])->group($key, $initial, $reduce);
        // $aggregate = yield Db::collection('hello')->where(['])->setInc('num');
//        $finddata = yield Db::collection('test')->where(['likes'=>100])->find();
//        $getdata = yield Db::collection('test')->where(['likes'=>100])->get();
//        $count = yield Db::collection('hello')->where(['like'=>['elt',5]])->count();
        $data = yield Db::collection('hello')->where(['title'=>'MongoDB0'])->get();
        $this->assign('data', $data);
        $this->setTemplate('home');
        $this->display('index');
    }
}