<?php
namespace app\admin\controller;

use think\facade\View;


class Login extends AdminBase
{
    public function initialize()
    {
        if($this->is_Login())
        {
            return $this->redirect(url("index/index"));
        }
    }

    public function index()
    {
        return View::fetch();
    }

    public function check()
    {
        if(!$this->request->isPost()){
            return show(config("status.error"),"请求方式错误");
        }

        $username = $this->request->param("username", "", "trim");
        $password = $this->request->param("password", "", "trim");
        $captcha = $this->request->param("captcha", "", "trim");
        // 1、原生模式，
        // if(empty($username) || empty($password) || empty($captcha)){
        //     return show(config("status.error"),"参数不能为空");
        // }
        //记得在中间件开启session
        // if(!captcha_check($captcha)){
        //     return show(config("status.error"),"验证码不正确".$captcha);
        // }
        // 2、TP6 validate验证机制   
        $data = [
            'username' => $username, 
            'password' => $password,
            'captcha' => $captcha,
        ];
        $validate = new \app\admin\validate\AdminUser();
        if(!$validate->check($data)){
            return show(config("status.error"), $validate->getError());
        }
        try {
            $result = \app\admin\business\AdminUser::login($data);
        } catch (\Exception $e){
            return show(config("status.error"), $e->getMessage());
        }

        if($result){
            return show(config("status.success"),"登录成功");
        }else{
            return show(config("status.error"),"登录失败");
        }
 
    }
    
}