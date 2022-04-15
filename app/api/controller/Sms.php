<?php 

namespace app\api\controller;

use app\BaseController;
use app\common\business\Sms as SmsBus;

class Sms extends BaseController {
    
    public function code(){
       
       $phoneNumber = input("param.phone_number", '', 'trim');
       //掉用business的数据 
       if(SmsBus::sendCode($phoneNumber)) {
          return  show("status.error", "发送验证码成功"); 
       } 
       return  show("status.error", "发送验证码成功"); 
    } 
}