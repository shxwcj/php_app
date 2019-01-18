<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/17
 * Time: 22:07
 */

namespace app\common\lib;

//引入鉴权类
use Qiniu\Auth;
//引入上传类
use Qiniu\Storage\UploadManager;


/**
 * 七牛图片基础类库
 * Class Upload
 * @package app\common\lib
 */

class Upload
{
    /**
     * 图片上传
     */

    public static function image()
    {
        if(empty($_FILES['file']['tmp_name'])) {
            exception('您提交的图片数据不合法', 404);
        }

        // 要上传文件的本地路径
        $file = $_FILES['file']['tmp_name'];

        //获取文件信息
        $pathinfo = pathinfo($_FILES['file']['name']);

        //获取文件扩展名
        $extension = $pathinfo['extension'];

        //配置qiniu参数
        $config = config('qiniu');

        //初始化签权对象
        $auth = new Auth($config['ak'], $config['sk']);

        //生成上传的token
        $token = $auth->uploadToken($config['bucket']);

        //上传到骑牛后保存的文件名
        $key  = date('Y')."/".date('m')."/".substr(md5($file), 0, 5).date('YmdHis').rand(0, 9999).'.'.$extension;

        //构建 UploadManager 对象
        $uploadMgr = new UploadManager();

        // 调用 UploadManager 的 putFile 方法进行文件的上传。
        list($ret, $err) = $uploadMgr->putFile($token, $key, $file);
        if ($err !== null) {
            return null;
        } else {
            return $key;
        }
    }
}