<?php

namespace app\common\model\mysql;

use think\Model;

class Cate extends Model
{

    public function getNormalCates($field = "*"){
        $where = [
            "status" => config("status.mysql.table_normal"),
        ];
        $result = $this->where($where)->field($field)->select();
        return $result;

    }

    public function getLists($where, $num = 10){
        $order = [
            "listorder" => "desc",
            "id" => "desc"
        ];
        $res = $this->where("status", "<>", config("status.mysql.table_delete"))
                    ->where($where)
                    ->order($order)
                    ->Paginate($num);
        return $res;            
    }

    public function updateById($id, $data){
        $data['update_time'] = time();
        return $this->where(["id" => $id])->save($data);
    }
}