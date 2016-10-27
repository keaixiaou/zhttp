<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 16/9/14
 * Time: 下午5:16
 */

namespace ZPHP\Controller;
use ZPHP\Core\Config;
use ZPHP\Core\Log;
use ZPHP\Core\Swoole;
use ZPHP\ZPHP;


/**
 * Class Controller
 * @package Controller
 */
class Controller {
    /**
     * @var $response
     */
    public $isApi=false;
    public $response;
    public $module;
    public $controller;
    public $method;

    protected $tplVar = [];
    protected $tplFile = '';
    protected $tmodule ;
    protected $tcontroller;
    protected $tmethod;
    /**
     * api接口请求总入口
     *
     */
    public function coroutineApiStart(){
        $result = yield call_user_func([$this, $this->method]);
        $result = json_encode($result);
//        Log::write('result:' . ($result), Log::INFO);
        $this->response->header('Content-Type', 'application/json');
        $this->response->end($result);
        $this->destroy();
    }


    /**
     * 指定模板文件
     * @param $tplFile
     * @throws \Exception
     */
    protected function analysisTplFile($tplFile){
        if(!empty($tplFile)){
            $tplExplode = explode('/', trim($this->tplFile,'/'));
            $tplCount = count($tplExplode);
            if($tplCount>3) {
                throw new \Exception("模板文件目录有误");
            }else if($tplCount==1){
                if(!empty($tplExplode[0])){
                    $this->tmethod = $tplExplode[0];
                }
            }else if($tplCount==2){
                if(!empty($tplExplode[0])){
                    $this->tcontroller = $tplExplode[0];
                }
                if(!empty($tplExplode[1])){
                    $this->tmethod = $tplExplode[1];
                }
            }else{
                if(!empty($tplExplode[2])){
                    $this->tmodule = $tplExplode[2];
                }
                if(!empty($tplExplode[1])){
                    $this->tcontroller = $tplExplode[1];
                }
                if(!empty($tplExplode[0])){
                    $this->tmethod = $tplExplode[0];
                }
            }
        }
    }

    /**
     * html web入口
     */
    public function coroutineHtmlStart(){
        $this->tmodule = $this->module;
        $this->tcontroller = $this->controller;
        $this->tmethod = $this->method;
        $data = yield call_user_func([$this, $this->method]);
        $this->analysisTplFile($this->tplFile);
        $tplPath = Config::getField('project', 'tpl_path', ZPHP::getRootPath() . DS.'apps'.DS  . 'view' . DS );
        $tplFile = $tplPath.$this->tmodule.DS.$this->tcontroller.DS.$this->tmethod.'.html';;
        \ob_start();
        extract($this->tplVar);
        if(!is_file($tplFile)){
            throw new \Exception("模板不存在.");
        }
        include "{$tplFile}";
        $content = ob_get_contents();
        \ob_end_clean();
        $this->response->status(200);
        $this->response->header('Content-Type','text/html');
        $this->response->end($content);
    }


    /**
     * 传入变量到模板
     * @param $name
     * @param $value
     */
    protected function assign($name, $value){
        $this->tplVar[$name] = $value;
    }


    /**
     * 载入模板文件
     * @param string $tplFile
     */
    protected function display($tplFile=''){
        if($tplFile!==''){
            $this->tplFile = $tplFile;
        }
    }
    /**
     * 异常处理
     */
    public function onExceptionHandle(\Exception $e){
        $msg = DEBUG===true?$e->getMessage():'服务器升空了!';
        $this->response->status(500);
        $this->response->end(Swoole::info($msg));
        $this->destroy();
    }

    /**
     * 系统异常错误处理
     * @param $message
     */
    public function onSystemException($message){
        $this->response->status(500);
        $this->response->end(Swoole::info('系统出现了异常:'.$message));
        $this->destroy();
    }

    protected function destroy(){
        if (ob_get_contents()) ob_end_clean();
        unset($this->response);
    }
}

