<?php

namespace app\common\model\mysql;

use think\Model;

class User extends Model
{
    //phone_number 获取用户数据
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

    //id 更新数据
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
    //id 获取用户数据
    public function getNormalUserById($id) {
        $id = intval($id);
        if(!$id) {
            return false;
        }
        return $this->find($id);
    }    
    //username 获取用户数据
    public function getNormalUserByUsername($username) {
        if(empty($username))
        {
            return false;
        }

        $where = [
            "username" => trim($username),
        ];
        
        $result =$this->where($where)->find();
        //echo $this->GetLastSql();
        return $result;
    }
}