<?php
namespace app\admin\controller;

use think\Controller;

class Index extends Base
{
    public function index()
    {
        //halt(session(config('admin.session_user'),'',config('admin.session_user_scope'))); //判断session是否清除成功
        return $this->fetch();
    }

    public function welcome()
    {
        return $this->fetch();
    }
}
