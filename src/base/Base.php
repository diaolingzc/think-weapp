<?php
namespace think_weapp\base;

use think\exception\HttpResponseException;
use think\exception\ValidateException;
use think\facade\Request;
use think\facade\Response;

class Base
{
	/**
     * @var Request Request 实例
     */
    protected $request;

    /**
     * 权限Auth
     * @var Auth 
     */
    protected $auth = null;

    /**
     * 默认响应输出类型,支持json/xml
     * @var string 
     */
    protected $responseType = 'json';

    /**
     * 构造方法
     * @access public
     * @param Request $request Request 对象
     */
    public function __construct(Request $request = null)
    {
        $this->request = is_null($request) ? Request::instance() : $request;

        // 控制器初始化
        $this->initialize();
    }

    /**
     * 初始化操作
     * @access protected
     */
    protected function initialize()
    {

    }

    /**
     * 操作成功返回的数据
     * @param  integer $statuscode http状态码，默认为200
     * @param  integer $code       错误码，默认为1000
     * @param  string  $msg        提示信息
     * @param  array   $data       要返回的数据
     * @param  [type]  $type       输出类型，支持json/xml/jsop
     * @param  array   $header     发送的 Header 信息
     */
    protected function success($statuscode = 200, $code = 1000, $msg = '', $data = [], $type = null, array $header = [])
    {
        $this->result($statuscode, $code, $msg, $data, $type, $header);
    }

    /**
     * 操作失败返回的数据
     * 
     * @param  integer $statuscode http状态码，默认为500
     * @param  integer $code       错误码，默认为500
     * @param  string  $msg        提示信息
     * @param  array   $data       要返回的数据
     * @param  [type]  $type       输出类型，支持json/xml/jsop
     * @param  array   $header     发送的 Header 信息
     */
    public function error($statuscode = 500, $code = 500, $msg = '', $data = [], $type = null, array $header = [])
    {
        $this->result($statuscode, $code, $msg, $data, $type, $header);
    }

    /**
     * 返回封装后的 API 数据到客户端
     * 
     * @param  integer $statuscode http状态码，默认为500
     * @param  integer $code       错误码，默认为500
     * @param  string  $msg        提示信息
     * @param  array   $data       要返回的数据
     * @param  [type]  $type       输出类型，支持json/xml/jsop
     * @param  array   $header     发送的 Header 信息
     * @return void
     * @throws HttpResponseException
     */
    protected function result($statuscode = 500, $code = 500, $msg = '', $data = [], $type = null, array $header = [])
    {
    	$result = [
            'code' => $code,
            'msg' => !empty($msg) ? $msg : '未定义消息',
            'time' => Request::instance()->server('REQUEST_TIME'),
            'data' => $code == 1000 ? $data : [],
        ];

        if ($code != 500 && isset(ReturnCode::$returnCode[$code]) && $result['code'] != '未定义消息') {
        	$result['msg'] = ReturnCode::$returnCode[$code];
        }

        /*$type = $type ? $type : ($this->request::param(config('var_jsonp_handler')) ? 'jsonp' : $this->responseType);*/
        $type = $type ? $type : $this->responseType;

        $response = Response::create($result, $type, $statuscode)->header($header);
        throw new HttpResponseException($response);
    }
}