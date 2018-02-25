<?php
namespace app\api\controller;

use think\Controller;
use think\Db;

Class Order extends Common
{

    public function __construct()
    {
        parent::__construct();
    }

	
	public function order_list(){
		$order_list = db_func("order")->where(['user_id'=>get_user_id()])->order("create_time desc")->select();
		
	}
	
	public function order_detail(){
		$order_id = input("order_id","");
		if(!is_numeric($order_id)){
			wrong_return("参数错误");
		}
		$order_info = db_func("order")->where(['id'=>$order_id,"user_id"=>get_user_id()])->find();
		if(!$order_info) wrong_return("获取失败");
		
	}

	public function pay(){
        //获取购物车
        $car_list =  db_func("shop_car s")
            ->field("s.*,g.true_price,g.show_price,g.img_src,g.desc,g.num  stock_num,g.title goods_name")
            ->join("goods g","g.id = s.goods_id",'left')
            ->where(['user_id'=>get_user_id(),"g.status"=>1])
            ->order('s.create_time desc')
            ->select();
        //获取地址信息
        $user_info = get_user_info();
        $this->assign('user_info',$user_info);
        $this->assign("list",$car_list);
        return $this->fetch('pay');

	}
	

	public function create_order(){
		try{
			$remark = input("remark","");
		if(!is_string($remark) && count($remark)>255) wrong_return("参数不正确");
		
		Db::startTrans();

		$order_data = [
				"nick_name"=>get_nick_name(),
				"user_id"=>get_user_id(),
				"order_name"=>get_nick_name().date("Y-m-d H:i:s",time())."购买订单",
				"price"=>0,
				"true_price"=>0,
				"sub_order_num"=>0,
				"status"=>1,
				"create_time"=>time(),
				"remark"=>$remark,
				"order_id"=>create_order_num()
		];
		
		$order_id = db_func("order")->insertGetId($order_data);
		if(!$order_id){
			throw new \Exception("创建失败");
		}

		$unmodify = true;
		$all_goods = db_func("shop_car s")
								->field("s.*,g.true_price,g.num  stock_num,goods_name")
								->join("goods g","g.id = s.goods_id",'left')
								->where(['user_id'=>get_user_id(),"g.status"=>1])
								->select();
		$total_price = 0;
		$sub_order_num = 0;
		foreach($all_goods as $key=>&$val){
			if($val['num']>$val['stock_num']){
				$unmodify = false;
				$val['num'] = $val['stock_num'];
			}
			$price = $val['num']*$val['true_price'];
			$total_price += $price;
			
			$sub_order_data = [
					"goods_name"=>$val['goods_name'],
					"goods_id"=>$val['goods_id'],
					"num"=>$val['num'],
					"true_price"=>$price,
					"price"=>$price,
					"nick_name"=>get_nick_name(),
					"user_id"=>get_user_id(),
					"status"=>1,
					"create_time"=>time(),
					"order_id"=>create_order_num(),
					"parent_id"=>$order_id
			];
			$insert_res = db_func("sub_order")->insert($sub_order_data);
			$sub_order_num ++;
			if(!$insert_res){
				throw new \Exception("订单创建失败");
			}
		}
		
		$update_res = db_func("order")->where(['id'=>$order_id])->update(["price"=>$total_price,"true_price"=>$total_price,"sub_order_num"=>$sub_order_num]);
		if(!$update_res){
			throw new \Exception("");
		}
		Db::commit();
		ok_return("创建成功");
		}catch(\Exception $e){
			Db::rollback();
			wrong_return($e->getMessage());
		}
		
	}
	
	public function del_order(){
		$order_id = input("order_id","");
		if(!is_numeric($order_id)){
			wrong_return("参数不正确");
		}
		$order_info = db_func("order")->where(['id'=>$order_id,"user_id"=>get_user_id(),"status"=>1])->delete();
		if($order_info !==false) {
			db_func("sub_order")->where(['parent_id'=>$order_id])->delete();
			ok_return("删除成功");
		}
		wrong_return("删除失败");
		
	}

	
    
}