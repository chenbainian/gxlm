<?php
namespace app\api\controller;

use think\Controller;

Class ShopCar extends Common
{

    public function __construct()
    {
        parent::__construct();
    }

	public function car_list(){
		$car_list =  db_func("shop_car s")
						->field("s.*,g.true_price,g.show_price,g.img_src,g.desc,g.num  stock_num,g.title goods_name,g.unit")
						->join("goods g","g.id = s.goods_id",'left')
						->where(['user_id'=>get_user_id(),"g.status"=>1])
						->order('s.create_time desc')
						->select();
		$this->assign("list",$car_list);
		return $this->fetch("shop_car");
	}

	public function add_car(){
		$goods_id = input('param.goods_id','');
		$num = (int)input('param.num',0);
		if(!chk_id($goods_id) || $num <= 0) wrong_return("数量不正确");
		$goods_info = db_func("goods")->where(['status'=>1,"id"=>$goods_id])->find();
		if(!$goods_info) wrong_return("没有查到该商品的信息");
		$car_info = db_func('shop_car')->where(['user_id'=>get_user_id(),'goods_id'=>$goods_id])->find();
		if($car_info){
			if($num + $car_info['num'] > $goods_info['num']){
				wrong_return("您添加的数量已经超出了库存");
			}
			$res = db_func('shop_car')->where(['id'=>$car_info['id']])->setInc('num',$num);
		}else{
			if($num > $goods_info['num']) wrong_return("您添加的数量已经超出了库存");
			$data = [
				'user_id'=>get_user_id(),
				'num'=>$num,
				'goods_id'=>$goods_id,
				'create_time'=>time()
			];
			$res = db_func('shop_car')->insert($data);
		}
		if($res) ok_return("添加成功");
		wrong_return("添加失败");

	}

	public function update_goods_num(){
		$car_id  = input("param.car_id",'');
		$num = input("param.num",1);
		if(!chk_id($car_id)||!is_numeric($num)){
			wrong_return("参数错误");
		}
		$car_info = db_func("shop_car")->where(['id'=>$car_id])->find();
		if(!$car_info) wrong_return("参数错误");
		$goods_info = db_func("goods")->where(['status'=>1,"id"=>$car_info['goods_id']])->find();
		if(!$goods_info) wrong_return("商品获取失败");

		if($num  > $goods_info['num']) wrong_return("您添加的数量已经超出了库存");
		if($num <= 0){
			$res = db_func('shop_car')->where(['id'=>$car_info['id']])->delete();
		}else{
			$res = db_func('shop_car')->where(['id'=>$car_info['id']])->update(['num'=>$num]);
		}


		if($res) ok_return("修改成功",1,['num'=>$num,'price'=>$goods_info['true_price']]);
		wrong_return("修改失败",-1,['num'=>$num,'price'=>$goods_info['true_price']]);
	}
	
	
	public function del_one_goods(){
		$car_id = input("car_id",'');
		if(!is_numeric($car_id))  wrong_return("参数错误");
		$del_res = db_func("shop_car")->where(['user_id'=>get_user_id(),'id'=>$car_id])->delete();
		if($del_res){
			ok_return("删除成功");
		}
		wrong_return("删除失败");
	}
	
	public function del_all(){
		$del_res = db_func("shop_car")->where(['user_id'=>get_user_id()])->delete();
		if($del_res){
			ok_return("删除成功");
		}
		wrong_return("删除失败");
	}
	
	public function init_price(){
		$all_goods = db_func("shop_car s")
					->field("s.*,g.true_price,g.num  stock_num")
					->join("goods g","g.id = s.goods_id",'left')
					->where(['user_id'=>get_user_id(),"g.status"=>1])
					->select();
		if(!$all_goods) wrong_return("您的购物车中没有商品");
		$total_price = 0;
		foreach($all_goods as $key=>&$val){
			$total_price += (float)bcmul($val['num'],$val['true_price']);
		}

		ok_return("计算成功",1,['total_price'=>$total_price]);
		
	}
	
	
    
}