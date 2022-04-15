<?php

namespace app\common\business;



class Sms {

    public static function sendCode($phoneNumber) {
        //生成短信验证码
        /*
        use app\common\lib\sms\AliSms;

        $code = rand(1000, 9999)
        $sms = AliSms::sendCode($phoneNumber, $code);
        if($sms){
            //我们需要把验证码记录到redis，并给出一个失效时间 1分钟。
            //1,PHP环境是否安装了Redis扩展 redis.dll linux unix: redis.so
            //2,redis服务

        }
        */
        cache(config("redis.code_pre").$phoneNumber, '1234', config("redis.code_expire"));
        return true;
    }

}