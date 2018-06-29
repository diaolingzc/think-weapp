<?php
/**
 * WxConfig 配置类
 * 
 * @author 云璃 <diaolingzc@sina.com>
 * @created 2018/06/15 16:20:03
 */
namespace think_weapp\base;

class WxConfig
{

    static public $wxConfig = [
        // 初始化 SDK 时缺少配置项
        'E_INIT_LOST_CONFIG' => 'E_INIT_LOST_CONFIG',
        // 初始化 SDK 时配置类型错误
        'E_INIT_CONFIG_TYPE' => 'E_INIT_CONFIG_TYPE',
        /* AUTH */
        // 自定义 http header
        'WX_HEADER_CODE' => 'x-wx-code',
        'WX_HEADER_ENCRYPTED_DATA' => 'x-wx-encrypted-data',
        'WX_HEADER_IV' => 'x-wx-iv',
        'WX_HEADER_SKEY' => 'x-wx-skey',
        // 腾讯云代理登录参数缺失
        'E_PROXY_LOGIN_LOST_PRAMA' => 'E_PROXY_LOGIN_LOST_PRAMA',
        // 腾讯云代理登录请求错误
        'E_PROXY_LOGIN_REQUEST_FAILED' => 'E_PROXY_LOGIN_REQUEST_FAILED',
        // 腾讯云代理登录失败
        'E_PROXY_LOGIN_FAILED' => 'E_PROXY_LOGIN_FAILED',
        // 解密失败
        'E_DECRYPT_FAILED' => 'E_DECRYPT_FAILED',
        // 登录成功
        'S_AUTH' => '1',
        // 登录失败
        'E_AUTH' => '0',
        /* 信道连接 */
        'E_CONNECT_TO_TUNNEL_SERVER' => 'E_CONNECT_TO_TUNNEL_SERVER',
        /* COS */
        'E_INIT_COS_SDK' => 'E_INIT_COS_SDK',
        // 是否输出 SDK 日志
        'EnableOutputLog' => FALSE,
        // SDK 日志输出目录
        'LogPath' => '',
        // SDK 日志输出级别（数组）
        'LogThreshold' => [],
        // 程序运行的根路径
        'RootPath' => '',
        // 微信小程序 AppID
        'AppId' => 'a',
        // 微信小程序 AppSecret
        'AppSecret' => 'b',
        // 是否使用腾讯云代理登录
        'UseQcloudLogin' => true,
        // COS 配置信息
        'Cos' => [
            'region' => 'cn-south',
            'fileBucket' => 'qcloudtest',
            'uploadFolder' => '',
            'maxSize' => 5,
            'field' => 'file'
        ],
        // 当前使用 SDK 服务器的主机，该主机需要外网可访问
        'ServerHost' => '',
        // 信道服务器服务地址
        'TunnelServerUrl' => '',
        // 和信道服务器通信的签名密钥，该密钥需要保密
        'TunnelSignatureKey' => '',
        // 腾讯云 AppID
        'QcloudAppId' => 123456789,
        // 腾讯云 QcloudSecretId
        'QcloudSecretId' => '',
        // 腾讯云 QcloudSecretKey
        'QcloudSecretKey' => '',
        // 微信消息通知 token
        'WxMessageToken' => '',
        // 微信登录态有效期
        'WxLoginExpires' => 7200,
        // 网络请求超时时长（单位：毫秒）
        'NetworkTimeout' => 3000,
    ];

}