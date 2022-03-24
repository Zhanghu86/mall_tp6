<?php

namespace app\admin\controller;

class Logout extends AdminBase
{
    public function index()
    {
        //清楚session
        session(config("admin.session_admin"), null);
        //执行跳转
        return redirect(url("login/index"));
    }
}