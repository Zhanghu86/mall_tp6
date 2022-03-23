<?php

namespace app\common\model\mysql;

//use think\console\command\make\Model;
use think\Model;

class AdminUser extends Model
{
    public function getAdminUserByUserName($username)
    {
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