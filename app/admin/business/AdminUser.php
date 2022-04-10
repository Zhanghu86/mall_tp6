<?php

namespace app\admin\business;

use app\common\model\mysql\AdminUser as AdminUserModel;
use think\Exception;

class AdminUser {

    public static function login($data){
        //try {} catch() {} 一加上就报错
        //try {
                $adminUserObj = new AdminUserModel();    

                $adminUser = self::getAdminUserByUserName($data['username']);
                //var_dump($adminUser);
                if(empty($adminUser)){
                    throw new Exception("不存在该用户");
                }            
                if($adminUser['password'] != md5($data['password']."_mall_tp6"))
                {
                    throw new Exception("密码错误"); 
                }                  
                $updateData = [
                    'last_login_time' => time(),
                    'last_login_ip' => request()->ip(),
                ];
                //var_dump($adminUser);
                $res = $adminUserObj->updateById($adminUser['id'], $updateData);
                if(empty($res))
                {
                    throw new Exception("更新失败");
                }           
        // } catch (\Exception $e){
        //     throw new Exception("内部异常，登录失败");
        // } 
        //记录session
        session(config("admin.session_admin"), $adminUser);
        return true;  

    }

    //通过用户名获取用户数据
    public static function getAdminUserByUserName($username){
        $adminUserObj = new AdminUserModel();
        $adminUser = $adminUserObj->getAdminUserByUserName($username);
        if(empty($adminUser) || $adminUser->status != config("status.mysql.table_normal"))
        {
            return false;  
        }
        $adminUser = $adminUser->toArray();
        return $adminUser;

    }
}