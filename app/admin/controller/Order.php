<?php
namespace app\admin\controller;

use think\Controller;

Class Order extends Common
{

    public function __construct()
    {
        parent::__construct();
    }

    public function order_list(){
        //获取所有得管理员
        $condition = [
            'nick_name'=>input('nick_name',''),
            'order_name'=>input('order_name',''),
            'order_id'=>input('order_id',''),
            'status'=>input('status','')
        ];
        $condition = array_filter($condition);

        $all_admin_user = db_func('order')->where($condition)->paginate(20);
        $this->assign('list',$all_admin_user->all());
        $this->assign('page',$all_admin_user->render());
        return $this->fetch('order_list');

    }

    public function sub_order_list(){
        $condition = [
            'goods_name'=>input('goods_name',''),
            'order_id'=>input('order_id',''),
            'status'=>input('status','')
        ];
        $condition = array_filter($condition);

        $all_admin_user = db_func('sub_order')->where($condition)->paginate(20);
        $this->assign('list',$all_admin_user->all());
        $this->assign('page',$all_admin_user->render());
        return $this->fetch('sub_order_list');
    }

    public function update_order_status(){
        $status = input('status','');
        $id = input('id','');
        if(empty($status) || empty($id)){
            wrong_return("参数不正确");
        }
        //如果状态为完成  则修改订单状态
        $updata_data = [
            'status'=>$status
        ];
        if($status  == 3){
            $updata_data['stop_time'] = NOW_TIME;
        }
        $update_res  = db_func("order")->where(['id'=>$id])->update($updata_data);
        if($update_res  === false) wrong_return("修改失败");

        ok_return("修改成功");
    }


    public function del_order(){
        $id = input('param.id','');
        if(empty($id)){
            wrong_return("订单ID不正确");
        }
        $del_res= db_func("order")->where(['id'=>$id])->delete();
        $sub_orders = db_func("sub_order")->where(['parent_id'=>$id])->select();
        foreach ($sub_orders as $key=>$value){
            db_func("goods")->where(['id'=>$value['goods_id']])->setInc('num',$value['num']);
        }
        db_func("sub_order")->where(['parent_id'=>$id])->delete();
        if($del_res  !== false){
            ok_return("删除成功");
        }else{
            wrong_return("删除失败");
        }
    }

    public function del_sub_order(){
        $id = input('param.id','');
        if(empty($id)){
            wrong_return("子订单ID不正确");
        }
        $sub_order_money = db_func("sub_order")->where(['id'=>$id])->find();
        if(!$sub_order_money) wrong_return("子订单状态异常");
        $money = $sub_order_money['price'];
        $true_money = $sub_order_money['true_price'];
        $parent_id = $sub_order_money['parent_id'];
        $del_res= db_func("sub_order")->where(['id'=>$id])->delete();

        db_func("order")->where(['id'=>$parent_id])->setDec('price',$money);
        db_func("order")->where(['id'=>$parent_id])->setDec('true_price',$true_money);
        db_func("order")->where(['id'=>$parent_id])->setDec('sub_order_num',1);

        db_func("goods")->where(['id'=>$sub_order_money['goods_id']])->setInc('num',$sub_order_money['num']);
        if($del_res !== false){
            ok_return("删除成功");
        }else{
            wrong_return("删除失败");
        }
    }

    public function update_order(){
        $id = input('param.id','');
        if(empty($id)) wrong_return("ID不正确");
        $order_info = db_func("order")->where(['id'=>$id])->find();
        $this->assign("info",$order_info);
        return $this->fetch('order_form');
    }

    public function update_sub_order(){
        $id = input('param.id','');
        if(empty($id)) wrong_return("ID不正确");
        $order_info = db_func("sub_order")->where(['id'=>$id])->find();
        $this->assign("info",$order_info);
        return $this->fetch('sub_order_form');
    }

    public function update_order_do()
    {
        if(empty(input('param.id'))){
            wrong_return("分类ID不正确");
        }

        $data = [
            'name'=>input('name',''),
            'status'=>input('status',''),
            'order'=>input('order',''),
            'parent_id'=>input('parent_id','')
        ];
        //检测重复性
        $same_cate = db_func("cate")->where(['name'=>$data['name'],'id'=>["neq",input('param.id')]])->find();
        if($same_cate) wrong_return("分类名已经存在");

        $update_res = db_func("cate")->where(['id'=>input('param.id')])->update($data);
        if($update_res  !== false){
            ok_return("修改成功");
        }
        wrong_return("修改失败");
    }

    public function update_sub_order_do(){
        if(empty(input('param.id'))){
            wrong_return("分类ID不正确");
        }

        $data = [
            'name'=>input('name',''),
            'status'=>input('status',''),
            'order'=>input('order',''),
            'parent_id'=>input('parent_id','')
        ];
        //检测重复性
        $same_cate = db_func("cate")->where(['name'=>$data['name'],'id'=>["neq",input('param.id')]])->find();
        if($same_cate) wrong_return("分类名已经存在");

        $update_res = db_func("cate")->where(['id'=>input('param.id')])->update($data);
        if($update_res  !== false){
            ok_return("修改成功");
        }
        wrong_return("修改失败");
    }
}