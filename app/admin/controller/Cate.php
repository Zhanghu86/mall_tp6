<?php
namespace app\admin\controller;

use app\admin\controller\Cate as ControllerCate;
use think\facade\View;
use app\common\business\Cate as CateBus;

class Cate extends AdminBase
{
    public function index()
    {
        $pid = input("param.pid", 0, "intval");
        $data = [
            "pid" => $pid,
        ];
        try {
            $cates = (new CateBus())->getLists($data, 1);   
        } catch (\Exception $e) {
            $cates = [];    
        }
        //halt($cates);
        return View::fetch("", [
            "cates" => $cates,
        ]);
    }

    public function listorder(){
        $id = input("param.id", 0, "intval");
        $listorder = input("param.listorder", 0, "intval");
        if(!$id){
            return show(config("status.error"), "参数错误");
        }
        try {
            $res = (new CateBus())->listorder($id, $listorder);
        } catch (\Exception $e) {
            return show(config("status.error"), $e->getMessage());
        }
        //var_dump($res);
        if($res){
            return show(config("status.success"), "排序成功");
        }else{
            return show(config("status.error"), "排序失败");
        }
    }

    public function add()
    {
        $cates = (new CateBus())->getNormalCates();
        //halt($cates);
        return View::fetch("", [
            "cates" => json_encode($cates),
        ]);
    }

    public function save()
    {
        $pid = input("param.pid", 0, "intval");
        $name = input("param.name", "", "trim");

        $data = [ 
            "pid" => $pid, 
            "name" => $name,
        ];
        //validate 效验
        //halt($data);
        try {
            $res = (new CateBus())->add($data);
        } catch (\Exception $e) {
            return show(config("status.error"), $e->getMessage());
        }
        if($res){
            return show(config("status.success"), "添加成功！");
        }else{
            return show(config("status.error"), "添加失败！");
        }
       
    }

    
}
