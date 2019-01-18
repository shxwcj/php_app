<?php

namespace app\common\model;

use think\Model;

class News extends Base
{
    /**
     * 后台自动化分页
     * @param array $data
     */
    public function getNews($data = [])
    {
        $data['status'] = [
            'neq', config('code.status_delete')
        ];

        // 查询
        $result = $this->where($data)
            ->order('id','desc')
            ->paginate();

        return $result;
    }

    /**
     * 根据来获取列表的数据
     * @param array $param
     */
    public function getNewsByCondition($condition = [], $from=0, $size = 5)
    {
        if(!isset($condition['status'])) {
            $condition['status'] = [
                'neq', config('code.status_delete')
            ];
        }

        // 查询
        $result = $this->where($condition)
            ->field($this->_getListField())
            ->limit($from, $size)
            ->order('id','desc')
            ->select();

        return $result;
    }

    /**
     * 通用化获取参数的数据字段
     */
    private  function _getListField()
    {
        return [
            'id',
            'catid',
            'image',
            'title',
            'read_count',
            'status',
            'is_position',
            'update_time',
            'create_time',
        ];
    }

    /**
     * 根据条件来获取列表的数据的总数
     * @param array $param
     */
    public function getNewsCountByCondition($condition = [])
    {
        if(!isset($condition['status'])) {
            $condition['status'] = [
                'neq', config('code.status_delete')
            ];
        }

        return $this->where($condition)
            ->count();

    }

    /**
     * 获取首页头图数据
     * @param int $num
     * @return array
     */
    public function getIndexHeadNormalNews($num = 4)
    {
        $data = [
            'status' => 1,
            'is_head_figure' => 1,
        ];

        return $this->where($data)
            ->field($this->_getListField())
            ->order('id','desc')
            ->limit($num)
            ->select();

    }
    /**
     * 获取推荐的数据
     */
    public function getPositionNormalNews($num = 20)
    {
        $data = [
            'status' => 1,
            'is_position' => 1,
        ];

        return $this->where($data)
            ->field($this->_getListField())
            ->order('id','desc')
            ->limit($num)
            ->select();

    }


    /**
     * 获取排行榜数据
     * @param int $num
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getRankNormalNews($num = 5)
    {
        $data = [
            'status' => 1,
        ];

        return $this->where($data)
            ->field($this->_getListField())
            ->order('read_count','desc')
            ->limit($num)
            ->select();
    }


}
