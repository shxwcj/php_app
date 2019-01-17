<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/17
 * Time: 14:25
 */


return [
    // 密码加密
    'password_pre_halt' => '#sing_ty',

    //aes 密钥 , 服务端和客户端必须保持一致
    'aeskey' => 'sgg45747ss223455',

    'apptypes' => [
        'ios',
        'android',
    ],

    // sign失效时间
    'app_sign_time' => 10,

    // sign 缓存失效时间
    'app_sign_cache_time' => 20,

    // 登录token的失效时间
    'login_time_out_day' => 7,
];