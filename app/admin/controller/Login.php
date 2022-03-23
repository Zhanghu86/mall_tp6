<?php
namespace app\admin\controller;

use app\BaseController;
use think\facade\View;
use app\common\model\mysql\AdminUser;

class Login extends BaseController
{
    public function index()
    {
        return View::fetch();
    }

    public function check()
    {
        if(!$this->request->isPost()){
            return show(config("status.error"),"请求方式错误");
        }

        //1、原生模式，2、TP6 验证机制
        $username = $this->request->param("username", "", "trim");
        $password = $this->request->param("password", "", "trim");
        $captcha = $this->request->param("captcha", "", "trim");
        if(empty($username) || empty($password) || empty($captcha)){
            return show(config("status.error"),"参数不能为空");
        }

        $adminUserObj = new AdminUser();
        $adminUser = $adminUserObj->getAdminUserByUserName($username);
        if(empty($adminUser) || $adminUser->status != config("status.mysql.table_normal"))
        {
            return show(config("status.error"), "不存在该用户");   
        }

        $adminUser = $adminUser->toArray();
        if($adminUser['password'] != md5($password."_mall_tp6"))
        {
            return show(config("status.error"), "密码错误");   
        }
        
        //记得在中间件开启session
        if(!captcha_check($captcha)){
            return show(config("status.error"),"验证码不正确".$captcha);
        }

        //记录session
        session(config("admin.session_admin"), $adminUser);

        $updateData = [
            'last_login_time' => time(),
            'last_login_ip' => request()->ip(),
        ];
        //var_dump($adminUser);
        $res = $adminUserObj->updateById($adminUser['id'], $updateData);
        if(empty($res))
        {
            return show(config("status.error"), "更新失败"); 
        }

        return show(config("status.success"), "登录成功");   
    }
    
}