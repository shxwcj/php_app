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
    //页数
    public $page = '';
    //每页显示多少条
    public $size = '';
    //查询条件的起始值
    public $form = 0;
    //定义model
    public $model = '';

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

    /**
     * 获取分页page size 内容
     */
    public function getPageAndSize($data) {
        $this->page = !empty($data['page']) ? $data['page'] : 1;
        $this->size = !empty($data['size']) ? $data['size'] : config('paginate.list_rows');
        $this->from = ($this->page - 1) * $this->size;
    }

    //删除逻辑
    public function delete($id)
    {
        if (!intval($id)){
            return $this->result('', 0, '传参有误');
        }

        //判断表与控制器是否相同是否相同
        $model = $this->model ? $this->model : request()->controller();

        try{
            $res = model($model)->save(['status' => -1,'id'=>$id]);
        }catch (\Exception $e){
            return $this->result('', 0, $e->getMessage());
        }

        if ($res){
            return $this->result(['jump_url' => $_SERVER['HTTP_REFERER']], 1, 'OK');
        }else{
            return $this->result('', 0, '删除失败');
        }
    }

    //通用化修改状态
    public function status()
    {
        $data = input('param.');

        $model = $this->model ? $this->model : request()->controller();
        try{
            $res = model($model)->save(['status'=>$data['status'],'id'=>$data['id']]);
        }catch (\Exception $e){
            return $this->result('', 0, $e->getMessage());
        }
        if ($res){
            return $this->result(['jump_url' => $_SERVER['HTTP_REFERER']], 1, 'OK');
        }else{
            return $this->result('', 0, '修改失败');
        }

    }


}