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

	
	public function ajax_order_list(){
        $user_id = get_user_id();
        $status = input('status','');
        if(empty($status)){
            $orders = db_func('order')->where(['user_id'=>$user_id])->order('create_time desc')->paginate(2);
        }else{
            $orders = db_func('order')->where(['user_id'=>$user_id,'status'=>$status])->order('create_time desc')->paginate(2);
        }

        if($orders->all()){
            $order_list = $orders->all();
            $page = preg_page($orders->render());

            $order_ids = array_column($order_list,'id');
            $sub_order_list = db_func("sub_order s")
                ->field('s.*,g.img_src,g.unit')
                ->join('goods g','g.id = s.goods_id','left')
                ->where(['parent_id'=>['in',$order_ids]])
                ->select();
            foreach ($order_list as $key=>$value){
                foreach ($sub_order_list as $key2=>$value2){
                    if($value['id'] == $value2['parent_id']){
                        $order_list[$key]['sub_orders'][] = $value2;
                    }
                }
            }
            $this->assign('pages',$page);
            $this->assign('order_list',$order_list);
            $data = [
                'code'=>1,
                'html'=>$this->fetch('ajax_order_list'),
            ];
        }else{
            $data = [
                'code'=>-1,
                'msg'=>'未查询到该订单'
            ];
        }
        die_json($data);
    }

	public function pay(){
        //获取购物车
        $car_list =  db_func("shop_car s")
            ->field("s.*,g.true_price,g.show_price,g.img_src,g.desc,g.num  stock_num,g.title goods_name,g.unit")
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

	public function pay_success()
    {
        try{
            //获取订单
            $order_id = input('order_id','');
            if(empty($order_id)) throw new \Exception();
            $order_info = db_func('order')->where(['order_id'=>$order_id])->find();
            if(!$order_info) throw new \Exception('sss');

            //获取用户收货信息
            $user_info = get_user_info();
            $this->assign('order_info',$order_info);
            $this->assign('user_info',$user_info);
            return $this->fetch('pay_success');
        }catch (\Exception $e){
            $this->redirect('api/index/index');
        }
    }


    public function submit(){
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
                    "order_id"=>'d'.create_order_num()
            ];
            $order_id = db_func("order")->insertGetId($order_data);
            if(!$order_id){
                throw new \Exception("创建失败");
            }

            $unmodify = true;
            $all_goods = db_func("shop_car s")
                                    ->field("s.*,g.true_price,g.num  stock_num,g.title goods_name")
                                    ->join("goods g","g.id = s.goods_id",'left')
                                    ->where(['user_id'=>get_user_id(),"g.status"=>1])
                                    ->select();
            $total_price = 0;
            $sub_order_num = 0;
            foreach($all_goods as $key=>&$val){
                if($val['num']>$val['stock_num'] || $val['num'] <= 0){
                    throw new \Exception("您的商品库存发生了变化,请重新下单");
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
                        "goods_price"=>$val['true_price'],
                        "price"=>$price,
                        "nick_name"=>get_nick_name(),
                        "user_id"=>get_user_id(),
                        "status"=>1,
                        "create_time"=>time(),
                        "order_id"=>'z'.create_order_num(),
                        "parent_id"=>$order_id
                ];
                $insert_res = db_func("sub_order")->insert($sub_order_data);
                if(!$insert_res){
                    throw new \Exception("订单创建失败");
                }
                //删除购物车
                $del_car = db_func('shop_car')->where(['id'=>$val['id']])->delete();
                if($del_car === false){
                    throw new \Exception("删除购物车失败");
                }
                //更新库存
                $update_goods = db_func('goods')->where(['id'=>$val['goods_id']])->setDec('num',$val['num']);
                if($update_goods === false){
                    throw new \Exception("库存更新失败");
                }
                $sub_order_num ++;
            }

            $update_res = db_func("order")->where(['id'=>$order_id])->update(["price"=>$total_price,"true_price"=>$total_price,"sub_order_num"=>$sub_order_num]);
            if(!$update_res){
                throw new \Exception("订单更新失败");
            }
            Db::commit();
            ok_return("创建成功",1,['order_id'=>$order_data['order_id']]);
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