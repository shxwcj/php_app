<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/17
 * Time: 15:07
 */

namespace app\admin\controller;

use think\Controller;

/**
 * 后台基础类库
 * Class Base
 * @package app\admin\controller
 */

class Base extends Controller
{
    //控制器初始化
    public function _initialize()
    {
        //判断用户是否登录
        $is_login = $this->is_login();
        if(!$is_login){
            return $this->redirect('login/index');
        }
    }

    /**
     * 判定是否登录
     * @return bool
     */
    public function is_login()
    {
        //获取session
        $user = session(config('admin.session_user'), '', config('admin.session_user_scope'));
        if($user && $user['id']) {
            return true;
        }

        return false;
    }




}