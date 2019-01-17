<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/16
 * Time: 16:05
 */

namespace app\admin\controller;

use think\Controller;
use think\Exception;

class Admin extends Controller
{
    public function add()
    {
        $ip = request()->ip();
        // 是否为 POST 请求
        if (request()->isPost()){
            $data = input("post.");
            $validate = validate('Admin');
            if(!$validate->check($data)){
               return $this->error($validate->getError());
            }
            $data['password'] = md5($data['password'].'#sing_ty');
            $data['status'] = 1;
            $data['last_login_ip'] = $ip;

            try{
               $id = model('AdminUser')->add($data);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
            if ($id){
                return $this->success('用户'.$data['username'].'添加成功');
            }else{
                return $this->error('添加失败');
            }
        }else{
            return $this->fetch();
        }

    }

}