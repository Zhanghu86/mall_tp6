<?php

namespace app\api\controller;


class Logout extends AuthBase {
    
    public function index() {
        //删除redis缓存
        $res = cache(config('redis.token_pre').$this->accessToken, null);
        if($res) {
            return show(config("status.success"), "退出成功");
        }
        return show(config("status.error"), "退出失败");
    }

}  