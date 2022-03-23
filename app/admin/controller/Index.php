<?php
namespace app\admin\controller;

use app\BaseController;

class Index extends BaseController
{
    public function index()
    {
        return "admin-index";
        //return show(config("status.success"), "登录成功"); 
        //echo md5("admin_mall_tp6");
    }

}
