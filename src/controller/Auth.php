<?php
namespace think_weapp\controller;

use think\facade\Config;
use think_weapp\base\Request;
use think_weapp\base\Base;

class Auth
{
	public static function login($code, $encryptData, $iv)
	{
		list($session_key, $openid) = array_values(self::getSessionKey($code));
	}

	/**
	 * 通过 code 换取 session key
	 * 
	 * @param  [type] $code 
	 */
	public static function getSessionKey($code)
	{
		/**
         * 是否使用腾讯云代理登录
         * $useQcProxy 为 true，sdk 将会使用腾讯云的 QcloudSecretId 和 QcloudSecretKey 获取 session key
         * 反之将会使用小程序的 AppID 和 AppSecret 获取 session key
         */
		if (Config::get('wx_config_data.UseQcloudLogin')) {
			return self::useQcloudProxyGetSessionKey(Config::get('wx_config_data.QcloudSecretId'), Config::get('wx_config_data.QcloudSecretKey'), $code);
		} else {
			$appid = Config::get('wx_config_data.AppId');
			return self::getSessionDirectiy(Config::get('wx_config_data.AppId'), Config::get('wx_config_data.AppSecret'), $code);
		}
	}

	public static function getSessionDirectiy($appId, $appSecret, $code)
	{
		$requestParams = [
            'appid' => $appId,
            'secret' => $appSecret,
            'js_code' => $code,
            'grant_type' => 'authorization_code'
        ];

        list($status, $body) = array_values(Request::get([
            'url' => 'https://api.weixin.qq.com/sns/jscode2session?' . http_build_query($requestParams),
            'timeout' => Config::get('wx_config_data.NetworkTimeout')
        ]));

        if ($status !== 200 || !$body || isset($body['errcode'])) {
        	self::error(401, 1041, Config::get('wx_config_data.E_PROXY_LOGIN_FAILED') . ':' . json_encode($body));
        }

        return $body;
	}

	public static function useQcloudProxyGetSessionKey($secretId, $secretKey, $code)
	{

	}

	private static function error($statuscode = 500, $code = 500, $msg = '', $data = [], $type = null, array $header = [])
	{
		$exception = new Base();
		$exception->error($statuscode, $code, $msg, $data, $type, $header);
	}
}