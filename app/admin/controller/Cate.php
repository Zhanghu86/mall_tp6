<?php
namespace app\admin\controller;

use think\facade\View;
use app\common\business\Cate as CateBus;
use app\common\lib\Status as StatusLib;

class Cate extends AdminBase
{
    public function index()
    {
        $pid = input("param.pid", 0, "intval");
        $data = [
            "pid" => $pid,
        ];
        try {
            $cates = (new CateBus())->getLists($data, 3);   
        } catch (\Exception $e) {
            $cates = [];    
        }
        //halt($cates);
        return View::fetch("", [
            "cates" => $cates,
            "pid" => $pid
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

    public function status(){
        $id = input("param.id", 0, "intval");
        $status = input("param.status", 0, "intval");
        if(!$id || !in_array($status, StatusLib::getTableStatus())){
            return show(config("status.error"), "参数错误");
        }
        try {
            $res = (new CateBus())->status($id, $status);
        } catch (\Exception $e) {
            return show(config("status.error"), $e->getMessage());
        }
        //var_dump($res);
        if($res){
            return show(config("status.success"), "状态更新成功");
        }else{
            return show(config("status.error"), "状态更新失败");
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
