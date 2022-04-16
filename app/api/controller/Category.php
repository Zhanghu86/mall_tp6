<?php 

namespace app\api\controller;

use app\common\business\Cate as CategoryBis;

class Category extends ApiBase {

    public function index() {
        //获取所有分类的内容
        $cateBusObj = new CategoryBis();
        $cates = $cateBusObj->getNormalAllCates();
        // halt($cates);

        $res = \app\common\lib\Arr::getTree($cates); 
        // halt($res);

        $res = \app\common\lib\Arr::sliceTreeArr($res, 5, 3, 5); 
        // halt($res);

        return show(config("status.success"), "ok", $res);
    }

}
