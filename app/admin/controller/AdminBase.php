<?php

namespace app\admin\controller;

use app\BaseController;
use think\exception\HttpResponseException;

class AdminBase extends BaseController
{
    public $adminUser = null;

    public function initialize()
    {

        parent::initialize();
        //是否登录 切换到中间件Auth中
        // if(empty($this->is_Login()))
        // {
        //     return $this->redirect(url("login/index"), 302);
        // }
    }
    //判断是否登录
    public function is_Login()
    {
        $this->adminUser = session(config("admin.session_admin"));
        //dump($this->adminUser);
        if(empty($this->adminUser))
        {
            return false;
        }
        return true;
    }

    public function redirect(...$args)
    {
        throw new HttpResponseException(redirect(...$args));
    }



}