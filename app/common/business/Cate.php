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