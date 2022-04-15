<?php

namespace app\common\business;

use app\common\model\mysql\User as UserModel;
use app\common\lib\Str;
use app\common\lib\Time;

class User {
    public $userObj = null;
    public function __construct()
    {
        $this->userObj = new UserModel();
    }  

    public function login($data) {
        $redisCode = cache(config("redis.code_pre").$data['phone_number']);
        if(empty($redisCode) || $redisCode != $data['code']) {
            throw new \think\exception("不存在该验证码", "-1009");
        }
        //判断是否有用户记录 phone_number 生成token
        $user = $this->userObj->getUserByPhoneNumber($data['phone_number']);

        if(!$user){

            $username = "mall-".$data['phone_number'];
            $userData = [
                'username' => $username,
                'phone_number' => $data['phone_number'],
                'type' => $data['type'],
                'status' => config('status.mysql.table_normal'),
            ];
            try {
                $this->userObj->save($userData);
                $userId = $this->userObj->id;
            }catch (\Exception $e) {
                throw new \think\Exception("数据库异常");
            }
        } else {
            //更新表
            $userId = $user->id;
            $username = $user->username;

        }
        $token = Str::getLoginToken($data['phone_number']);
        $redisData = [
            'id' => $userId,
            'username' => $username,
        ];
        $res = cache(config('redis.token_pre').$token, $redisData, Time::userLoginExpireTime($data['type']));

        return $res ? ['token' => $token, 'username' => $username] : false;

    }

    //id 获取正常用户数据
    public function getNormalUserById($id) {
        $user = $this->userObj->getNormalUserById($id);
        if(!$user || $user->status != config("status.mysql.table_normal")) {
            return [];
        }
        return $user->toArray();
    }

    public function update($id, $data) {
        //检查用户名
        $user = $this->userObj->getNormalUserById($id);
        if(!$user) {
            throw new \think\Exception("不存在该用户");
        }
        $userRes = $this->userObj->getNormalUserByUsername($data['username']);
        if($userRes && $userRes['id'] != $id){
            throw new \think\Exception("该用户已经存在请重新输入");
        }
        return $this->userObj->updateById($id, $data);
    }

}