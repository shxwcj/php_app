<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/16
 * Time: 16:23
 */

namespace app\common\validate;

use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'username'  =>  'require|max:50|unique:admin_user',
        'password' =>  'require|max:18|alphaNum',
    ];
    protected $message  =   [
        'username.require'  => '用户名不能为空',
        'username.max'      => '用户名最多不能超过50个字符',
        'username.unique'   => '用户名已被占用',
        'password.require'  => '密码不能为空',
        'password.max'  => '密码最多不能超过18个字符',
        'password.alphaNum' => '密码由字母或数字组成',
    ];
}