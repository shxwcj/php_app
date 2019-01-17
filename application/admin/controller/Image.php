<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/17
 * Time: 16:28
 */

namespace app\admin\controller;

use app\common\lib\Upload;
use think\Controller;
use think\Request;

/**
 * 后台图片上传相关逻辑
 * Class Image
 * @package app\admin\controller
 */

class Image extends Base
{
    /**
    *图片上传
     */

    public function upload0()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = Request::instance()->file('file');
        // 把图片上传到指定的文件夹中
        $info = $file->move('upload');
        if ($info && $info->getPathname()){
            $data = [
                'status'=>1,
                'message'=>'ok',
                'data'=> '/'.$info->getPathname(),
            ];
            return json_encode($data);exit();
        }
        return json_encode(['status' => 0, 'message' => '上传失败']);
    }

    /**
     *七牛云图片上传
     */

    public function upload()
    {
       try{
           $image = Upload::image();
       }catch (\Exception $e){
            return json_encode(['status' => 0, 'message' => $e->getMessage()]);
       }
       //更新数据
       if ($image){
           $data = [
               'status' => 1,
               'message' => 'ok',
               'data' => config('qiniu.image_url').'/'.$image,
           ];
           return json_encode($data);
           exit();
       }else{
           return json_encode(['status' => 0, 'message' => '上传失败']);
       }
    }
}