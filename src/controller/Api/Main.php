<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2017/2/8
 * Time: 上午9:25
 */


namespace controller\Api;

use ZPHP\Controller\Controller;
use ZPHP\Core\App;
use ZPHP\Core\Db;
use ZPHP\Core\Log;
use ZPHP\Coroutine\Http\HttpClientCoroutine;

class  Main extends Controller{
    protected function init(){
//        $check = yield App::middleware('Authtoken')->check('uf_135167_zchat');
//        Log::write('check:'.print_r($check, true));
//        if(!$check){
//            $this->strReturn("no token");
//        }
        return parent::init();
    }


    /**
     * @method POST
     * @description  首页接口
     * @param int $a  用户编号 optional
     * @param int $b 用户名称
     * @return String $c 用户性别
     * @return Int $a 用户编号
     * @return Array $list 列表
     * @return _Int $c 昵称
     * @return _object $d 用户对象
     * @return __object $f 对象f
     * @return ___object $g 对象g
     * @return ____int $f 对象f
     * @return int $data 数据
     * @return Array $data 列表
     * @return _Int $c 昵称
     * @return _object $d 用户对象
     * @return __object $f 对象f
     * @return ___object $g 对象g
     * @return ____object $g 对象g
     * @return _____int $g 对象g
     * @return _____object $g 对象g
     * @return ______string $k 对象K
     */
    PUBLIC function index(){

        $a = ['a'=>1];
//        $a = App::model('Test');
//        throw new \Exception(print_r($a, true));
        $id = $this->request->get('id');
//        $this->redirect('http://www.baidu.com/');
//        $module = Db::getSwooleModule()->cppMethod(333);
//        $redis = yield Db::redis()->lpop('myqueue');
//        $this->jsonReturn($redis);
//        $redis = yield Db::redis()->cache('abcd1');
//        $i = 12;
//        while($i<=100){
//            $data = [
//                'no' => $i,
//                'content'=>str_repeat(strval($i),3),
//                'age' => $i,
//                'school' => $i,
//            ];
//            $redis = yield Db::table('test')->add($data);
//            $i++;
//        }
//        $redis = yield Db::table()->query("update test set content='51456467' where id=1;");
//        $redis = json_encode($redis);
//        $redis = getmypid();
//        $task = ['class'=>\service\Test::class,'method'=>'task','param'=>'task1'];
//        Db::task()->call($task);

//        $task['param'] = 'task2';
//        $taskRes = yield Db::task()->callCoroutine($task);
        $res =  "hello world!".$id;
        Log::write('res:'.$res);
        $this->jsonReturn($this->request);


    }

    /**
     * @method POST
     * @param int id id
     * @param string name 姓名
     * @param string test 字符串
     * @return json $test 字符串
     */
    public function mongoget(){
        $redis = yield Db::collection('test')->get();
        $redis = json_encode($redis);
        $this->strReturn('Main-Index'.$redis);
    }

    /**
     *
     */
    public function mongofind(){
        $redis = yield Db::collection('test')->find();
        $redis = json_encode($redis);
        $this->strReturn('Main-Index'.$redis);
    }

    /**
     *
     */
    public function memcached(){
        $redis = yield Db::memcached()->cache('test','testtest');
        $this->strReturn('Main-Index'.$redis);
    }

    /**
     *
     */
    public function memcachedget(){
        $redis = yield Db::memcached()->cache('test');
        $redis = json_encode($redis);
        $this->strReturn('Main-Index'.$redis);
    }

    /**
     *
     */
    public function redis(){
        $redis = yield Db::redis()->get('uf_135167_zchat');
        $this->strReturn($redis.uniqid());
    }

    /**
     *
     */
    public function rediszset(){
        $redis = yield Db::redis()->zrange('mylist', 0,  300);
        $this->jsonReturn($redis);
    }

    /**
     *
     */
    public function redisdelete(){
        $redis = yield Db::redis()->del('test');
        $this->strReturn($redis.uniqid());
    }

    /**
     *
     */
    function mysql(){
        $redis = yield Db::table('user')->where(['id'=>1])->find();
        $this->jsonReturn($redis);
    }


    function mysql_query(){
        $redis = yield Db::table('user')->query('begin222');
//        $redis = yield Db::table('user')->query('select * from user where id =1');
        Log::write('res:'.print_r($redis, true));
//        $redis = yield Db::table('user')->query('begin');
        $this->jsonReturn($redis);
    }

    function mysql_setinc(){
        $redis = yield Db::table('test')->where(['id'=>10])->setInc('no');
        $this->jsonReturn($redis);
    }

    function mysql_setdec(){
        $redis = yield Db::table('test')->where(['id'=>10])->setDec('no');
        $this->jsonReturn($redis);
    }

    public function mysqltrans(){
        $transId = yield Db::table()->startTrans();
//        $transId = '';
        $data = ['nickname'=>'keaxiaou444'];
        $res1 = yield Db::table('user')->setTransId($transId)
            ->where(['id'=>4])->save($data);
        if($res1===false){
            $res1 = yield Db::table()->setTransId($transId)->rollback();
            $this->strReturn('rollback');
        }else{
            $res2 = yield Db::table('user')->setTransId($transId)
                ->where(['id'=>5])->save(['nickname'=>'keaixiaou55']);
            if($res2===false){
                $res2 = yield Db::table()->setTransId($transId)->rollback();
                $this->strReturn('rollback');
            }else {
                $res2 = yield Db::table()->setTransId($transId)->commit();
                $this->strReturn('commit');
            }
        }


    }

    function http(){
        $httpClient = new HttpClientCoroutine();
        $html = yield $httpClient->request('http://www.baidu.com/');
        $this->strReturn($html);
    }
}