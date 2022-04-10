<?php

namespace app\api\validate;

use think\Validate;

class User extends Validate {

    protected $rule = [
        'username' => 'require',
        "phone_number" => "require",
        "code" => "require|number|min:4",
        //"type" => "require|in:1,2"
        "type" => ["require", "in"=>"1,2"],//俩种不同的方式
    ];

    protected $message = [
        "username" => "用户名不能为空",
        "phone_number" => "电话号码不能为空",
        "code.require" => "短信验证码必须",
        "code.number" => "短信验证码必须是数字",
        "code.min" => "短信验证码不低于4",
        "type.require" => "类型必须",
        "type.in" => "类型数值错误",
    ];

    protected $scene = [
        'send_code' => ['phone_number'],
        'login' => ['phone_number', 'code', 'type'],
    ];



}