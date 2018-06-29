<?php

namespace think_weapp\base;

use think\facade\Config;
use think\facade\Cache;

class WxApi extends Base
{
	protected $code;
	protected $encryptedData;
	protected $iv;
	protected $header;

	protected function initialize()
    {
    	parent::initialize();
    	$this->header = $this->request::header();
    	$this->setConfig();
        $this->getWxHttpHeader();
    	//$this->isWxHttp();
    }

	protected function setConfig()
    {
        $this->config = Cache::get('wx_config_data');
    	if (!$this->config) {
            $this->config = WxConfig::$wxConfig;
            Cache::set('wx_config_data', $this->config);
        }
        Config::set($this->config,'wx_config_data');
    }
    /**
     * 获取微信小程序头部信息
     */
    protected function getWxHttpHeader()
    {
        $this->code = $this->isGetWxHttpHeader(Config::get('wx_config_data.X_WX_CODE'));
        $this->encryptedData = $this->isGetWxHttpHeader(Config::get('wx_config_data.WX_HEADER_ENCRYPTED_DATA'));
        $this->iv = $this->isGetWxHttpHeader(Config::get('wx_config_data.WX_HEADER_IV'));
    }
    
    /**
     * 获取header头信息
     *
     * @param string headerkey
     * @return string string | ''
     */
    protected function isGetWxHttpHeader($header)
    {
        return isset($this->header[$header]) ? $this->header[$header] : '';
    }

    protected function isWxHttp(){
    	if (!$this->code) {
    		$this->error(403, 1040);
    	}
    }
}
