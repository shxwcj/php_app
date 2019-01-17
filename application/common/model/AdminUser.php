<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/16
 * Time: 16:52
 */

namespace app\common\model;

use think\Model;

class AdminUser extends Model
{
    protected  $autoWriteTimestamp = true;
    /**
     * 新增
     * @param $data
     * @return mixed
     * */
    public function add($data)
    {
        if (!is_array($data))
        {
            exception('传递数据不合法');
        }
        //过滤post数组中的非数据表字段数据
        $this->allowField(true)->save($data);
        return $this->id;
    }
}