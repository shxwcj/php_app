<?php

namespace app\common\model;

use think\Model;

class Base extends Model
{
    //允许使用时间戳
    protected  $autoWriteTimestamp = true;

    /**
     * 新增
     * @param $data
     * @return mixed
     */
    public function add($data) {
        if(!is_array($data)) {
            exception('传递数据不合法');
        }
        $this->allowField(true)->save($data);

        return $this->id;
    }

}
