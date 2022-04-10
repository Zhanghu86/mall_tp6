<?php

namespace app\common\model\mysql;

use think\Model;

class User extends Model
{

    public function getUserByPhoneNumber($phoneNumber)
    {
        if(empty($phoneNumber))
        {
            return false;
        }

        $where = [
            "phone_number" => trim($phoneNumber),
        ];
        
        $result =$this->where($where)->find();
        //echo $this->GetLastSql();
        return $result;
    }

    public function updateById($id, $data)
    {
        $id = intval($id);
        if(empty($id) || empty($data) || !is_array($data))
        {
            return false;
        }

        $where = [
            'id' => $id,
        ];

        return $this->where($where)->save($data);

    }
}