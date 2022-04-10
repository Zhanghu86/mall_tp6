<?php

namespace app\common\business;

use app\common\model\mysql\User as UserModel;
use app\common\lib\Str;

class User {
    public $userObj = null;
    public function __construct()
    {
        $this->userObj = new UserModel();
    }  

    public function login($data) {
        $redisCode = cache(config("redis.code_pre").$data['phone_number']);
        if(empty($redisCode) || $redisCode != $data['code']) {
            //throw new \think\exception("不存在该验证码", "-1009");
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
        $res = cache(config('redis.token_pre').$token, $redisData);

        return $res ? ['token' => $token, 'username' => $username] : false;

    }
}