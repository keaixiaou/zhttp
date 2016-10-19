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

    /**
     * api接口请求总入口
     *
     */
    public function coroutineApiStart(){
        $result = yield call_user_func([$this, $this->method]);
        $result = json_encode($result);
        Log::write('result:' . ($result), Log::INFO);
        $this->response->end($result);
        $this->destroy();
    }

    /**
     * html web入口
     */
    public function coroutineHtmlStart(){
        yield call_user_func([$this, $this->method]);
        if($this->tplFile===''){
            $tplPath = Config::getField('project', 'tpl_path', ZPHP::getRootPath() . DS  . 'view' . DS );
            $this->tplFile = $this->module.DS.$this->controller.DS.$this->method.'.php';
        }
        $tplFile = $tplPath.$this->tplFile;
        \ob_start();
        extract($this->tplVar);
        include "{$tplFile}";
        $content = ob_get_contents();
        \ob_end_clean();
        $this->response->status(200);
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