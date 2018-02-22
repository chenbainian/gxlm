<?php
namespace app\api\controller;

use think\Controller;

Class Goods extends Common
{

    public function __construct()
    {
        parent::__construct();
    }

	public function goods_detail(){
		$goods_id = input("goods_id","");
		if(empty($goods_id)||!is_numeric($goods_id)){
			wrong_return("没有该商品");
		}
		$condition = [
			'status'=>1
		];
		$goods_info = db_func("goods")->field('id,title,show_price,true_price,desc,img_src,num,unit,cate_id,big_cate_id')->where($condition)->find();
		if(!$goods_info){
			wrong_return("没有该商品");
		}

		$big_cate_name = db_func("cate")->where(['id'=>$goods_info['big_cate_id']])->find();
		$small_cate_name = db_func("cate")->where(['id'=>$goods_info['cate_id']])->find();
		$this->assign('big_cate_name',$big_cate_name['name']);
		$this->assign('small_cate_name',$small_cate_name['name']);
		$this->assign('goods_info',$goods_info);
		return $this->fetch('detail');
	
	}
	
	public function goods_list(){
		$condition = [
			'cate_id'=>input("cate_id",''),
			'status'=>1
		];
		//获取最小分类ID  查询
		$goods_list = db_func("goods")->field('id,title,show_price,true_price,desc,img_src,num,unit,order,cate_id')->where($condition)->order("order asc")->select();
		if(!$goods_list){
			wrong_return("商品列表为空");
		}
		$data  = [
			"code"=>200,
			"msg"=>"获取成功",
			"data"=>$goods_list
		];
		die_json($data);
	}

	public function search(){
		$goods_name = input('goods_name','');
		$big_cate_list = db('cate')->where(['type'=>1,'status'=>1])->order('`order` asc')->select();
		$condition = [];
		if(!empty($big_cate_list)){
			$condition = ['parent_id'=>$big_cate_list[0]['id']];
		}
		$small_cate_list = db('cate')->where(['type'=>2,'status'=>1])->where($condition)->order('`order` asc')->select();

		//获取该商品
		$goods_list = db('goods')->where(['title'=>['like','%'.$goods_name.'%'],'status'=>1])->paginate(12);

		$this->assign('goods_list',$goods_list);
		$this->assign('goods_name',$goods_name);
		$this->assign('big_cate_list',$big_cate_list);
		$this->assign('small_cate_list',$small_cate_list);
		return $this->fetch('search');
	}

	public function small_cate_list(){
		$big_cate_list = db('cate')->where(['type'=>1,'status'=>1])->order('`order` asc')->select();
		$this->assign('cate_list',$big_cate_list);
		$return_data = [
			'code'=>200,
			'msg'=>'获取成功',
			'html'=>$this->fetch('big_cate_list')
		];
		die_json($return_data);
	}

	public function big_cate_list(){
		$big_cate_id = input('big_cate_id','');
		if(empty($big_cate_id)){
			$data = [];
		}else{
			$data = db('cate')->where(['type'=>2,'status'=>1])->where(['parent_id'=>$big_cate_id])->order('`order` asc')->select();
		}
		$this->assign('cate_list',$data);
		$return_data = [
			'code'=>200,
			'msg'=>'获取成功',
			'html'=>$this->fetch('small_cate_list')
		];
		die_json($return_data);

	}
	
    
}