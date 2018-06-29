<?php
namespace think_weapp\controller;

use think_weapp\base\WxApi;

class Login extends WxApi
{
	public function login()
	{
		return Auth::login($this->code, $this->encryptedData, $this->iv);
	}
}