<?php

namespace app\admin\middleware;

class Auth {
    
    public function handle($request, \Closure $next)
    {
        //dump($request->pathinfo());
        //前置中间件
        if(empty(session(config("admin.session_admin"))) && !preg_match("/(login|verify)/", $request->pathinfo()))
        {
            return redirect(url("login/index"));
        }
        $response = $next($request);
        //后置中间件 先执行控制器中的方法，最后没有输出
        // if(empty(session(config("admin.session_admin"))) && $request->controller() != "Login" )
        // {
        //     return redirect((string) url("login/index"));
        // }
        return $response;
    }

    public function end(\think\Response $response)
    {

    }
}