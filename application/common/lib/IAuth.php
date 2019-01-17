<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/17
 * Time: 14:21
 */

namespace app\common\lib;
use think\Cache;

class IAuth
{
    /**
     * 设置密码
     * @param string $data
     * @return string
     */

    public static function setPassword($data)
    {
        return md5($data.config('app.password_pre_halt'));
    }




}
