<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/16
 * Time: 21:53
 */

namespace app\common\validate;

use think\Validate;

class Login extends Validate
{
    protected $rule = [
        'username'  =>  'require|max:50',
        'password' =>  'require|max:18|alphaNum',
    ];
    protected $message  =   [
        'username.require'  => '用户名不能为空',
        'username.max'      => '用户名最多不能超过50个字符',
        'password.require'  => '密码不能为空',
        'password.max'  => '密码最多不能超过18个字符',
        'password.alphaNum' => '密码由字母或数字组成',
    ];
}