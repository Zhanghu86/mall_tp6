<?php

namespace app\common\business;

use app\common\model\mysql\Cate as CateModel;

class Cate {
    public $model = null;
    public function __construct() {    
        $this->model = new CateModel();
    }

    public function getLists($data, $num){
        $list = $this->model->getLists($data, $num);
        if(!$list){
            return [];
        }
        $res = $list->toArray();
        $res["render"] = $list->render();

        //1， 求pid 2，in mysql 求count 3，count渲染
        $pids = array_column($res['data'], "id"); //返回数组中id的数组[1, 2]
        if($pids){
            $idCountRes = $this->model->getChildCountInPids(['pid' => $pids]);
            $idCountRes = $idCountRes->toArray();

            $idCounts = [];
            foreach($idCountRes as $countRes){
                $idCounts[$countRes['pid']] = $countRes['count'];//id => count
            }           
        } 
        if($res['data']){
            foreach($res['data'] as $k => $v){
                //$a ?? 0 等同于isset($a) ? $a :0
                $res['data'][$k]['childCount'] = $idCounts[$v['id']] ?? 0; 
            }
        }

        return $res;
    }

    public function getById($id){
        $res = $this->model->find($id);
        if(empty($res)){
            return [];
        }
        $res = $res->toArray();
        return $res;
    }

    public function listorder($id, $listorder){
        $res = $this->getById($id);
        if(!$res){
            throw new \think\Exception("不存在该条记录");
        }
        $data = [
            "listorder" => $listorder,
        ];
        try {
            $res = $this->model->updateById($id, $data);
        } catch (\Exception $e) {
            return false;
        }
        return $res;
    }   
    
    public function status($id, $status){
        $res = $this->getById($id);
        if(!$res){
            throw new \think\Exception("不存在该条记录");
        }
        if($res['status'] == $status){
            throw new \think\Exception("修改前与修改后一样无意义");
        }
        $data = [
            "status" => intval($status),
        ];
        try {
            $res = $this->model->updateById($id, $data);
        } catch (\Exception $e) {
            return false;
        }
        return $res;
    }
    
    public function add($data) {

        $data['status'] = config("status.mysql.table_normal");
        $this->model->save($data);
        return $this->model->id;

    } 

    public function getNormalCates(){
        $field = "id, name, pid";
        $cates = $this->model->getNormalCates($field);
        if(!$cates){
            $cates = [];
        }
        $cates = $cates->toArray();
        return $cates;
    }
}