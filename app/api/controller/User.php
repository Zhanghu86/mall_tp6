<?php

namespace app\api\controller;

use app\common\business\User as UserBis;

class User extends AuthBase {

    public function index() {
        $user = (new UserBis())->getNormalUserById($this->userId);

        $res = [
            'id' => $this->userId,
            'username' => $user['username'],
            'sex' => $user['sex'],
        ];
        return show(config("status.success"), "ok", $res);
    }

    public function update() {
        $username = input("param.username", "", "trim");
        $sex = input("param.sex", 0, "intval");

        $data = [
            'username' => $username,
            'sex' => $sex
        ];

        $userBisObj = new UserBis();
        $user = $userBisObj->update($this->userId, $data);
        if(!$user){
            return show(config("status.error"), "更新失败");
        }
        //如果用户名被修改，redis中的数据也需要同步修改。
        return show(1, "ok");
    }

}