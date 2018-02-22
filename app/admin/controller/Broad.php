<?php
namespace app\admin\controller;

use think\Controller;

Class Broad extends Common
{

    public function __construct()
    {
        parent::__construct();
    }


    public function broad_list(){
        //获取所有分类
        $all_img = db_func('broad_img')->order('`order`')->select();
        $this->assign('list',$all_img);
        return $this->fetch('list');
    }

    public function del(){
        $id = input("id",'');
        if(empty($id)) wrong_return("参数不正确");
        $res = db_func('broad_img')->where(['id'=>$id])->delete();
        if($res) ok_return("删除成功");
        wrong_return("删除失败");
    }

    public function update(){
        $id = input("id",'');
        if(empty($id)) wrong_return("参数不正确");
        $info = db('broad_img')->where(['id'=>$id])->find();
        if(!$info) wrong_return("不存在该信息");
        $this->assign('info',$info);
        return $this->fetch("form");
    }

    public function update_do(){
        $data = [
            'id'=>input('id',''),
            'img_src'=>input('img_src',''),
            'order'=>input('order',1),
            'bg_color'=>input('bg_color','')
        ];
        if(empty($data['id'])) wrong_return("参数不正确");
        $res = db('broad_img')->where(['id'=>$data['id']])->update($data);
        if($res !== false){
            ok_return("修改成功");
        }
        wrong_return("修改失败");
    }

    public function add(){
        return $this->fetch("add_form");
    }

    public function add_do(){
        $data = [
            'img_src'=>input('img_src',''),
            'order'=>input('order',1),
            'bg_color'=>input('bg_color','')
        ];
        if(empty($data['img_src'])) wrong_return("参数不正确");
        $res = db('broad_img')->insert($data);
        if($res !== false){
            ok_return("添加成功");
        }
        wrong_return("添加失败");
    }
}