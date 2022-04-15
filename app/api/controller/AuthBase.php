<?php

namespace app\api\controller;


class AuthBase extends ApiBase {

    public $userId = 0;
    public $userName = "";
    public $accessToken = "";

    public function initialize() 
    {
        parent::initialize();
        $this->accessToken = $this->request->header("access-token");
        if(!$this->accessToken || !$this->isLogin()) {
            return $this->show(config("status.not_login"), "没有登录");
        }

    }
    //是否登录
    public function isLogin() {
        $userInfo = cache(config('redis.token_pre').$this->accessToken);
        if(!$userInfo) {
            return false;
        }
        if(!empty($userInfo['id']) &&  !empty($userInfo['username'])) {
            $this->userId = $userInfo['id'];
            $this->userName = $userInfo['username'];
            return true;
        }        
        return false;
    }
    
}