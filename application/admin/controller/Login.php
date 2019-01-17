<?php

namespace app\admin\controller;

use app\common\model\AdminUser;
use think\Controller;
use app\common\lib\IAuth;

class Login extends Base
{
    //控制器初始化
    public function _initialize()
    {
    }

    /**
     * 登录页面
     *
     * @return \think\Response
     */
    public function index()
    {
        //判断用户是否登录
        $is_login = $this->is_login();

        if ($is_login){
            return $this->redirect('index/index');
        }else{
            return $this->fetch();
        }
    }

    /**
     * 提交登录数据
     *
     * @return mixed
     */
    public function check()
    {
        if (request()->isPost()){
            $data = input('post.');

            //验证数据是否合法
            $validate = validate('Login');
            if(!$validate->check($data)){
                return $this->error($validate->getError());
            }
            //验证码验证
            if(!captcha_check($data['code'])){
                //验证失败
                return $this->error('验证码不准确');
            };

           try{
               $user = model('AdminUser')->get(['username'=>$data['username']]);
           }catch (\Exception $e){
               return $this->error($e->getMessage());
           }

           //判断用户名
           if(!$user || $user->status != config('code.status_normal')){
               return $this->error('该用户不存在');
           }
            // 再对密码进行校验
           if (IAuth::setPassword($data['password']) != $user['password']){
               return $this->error('密码不正确');
           }

            // 1 更新数据库 登录时间 登录ip
            $updatedata = [
                'last_login_time'=>time(),
                'last_login_ip'=>request()->ip(),
            ];
           try{
               model('AdminUser')->save($updatedata,['id' => $user->id]);
           }catch (\Exception $e){
                return $this->error($e->getMessage());
           }

           //2.存储session中
            session(config('admin.session_user'),$user,config('admin.session_user_scope'));

           return $this->success('登录成功','index/index');
        }else{
            return $this->error('请求方式错误');
        }


    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }

    /**
     * 退出登录的逻辑
     * 1、清空session
     * 2、 跳转到登录页面
     */
    public function logout()
    {
        // 清除session（当前作用域）
        session(null,config('admin.session_user_scope'));
        //跳转登录页面
        return $this->redirect('login/index');
    }
}
