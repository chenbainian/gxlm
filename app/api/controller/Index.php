<?php
namespace app\api\controller;

use think\Controller;

Class Index extends Common
{

    public function __construct()
    {
        parent::__construct();
    }

	public function index(){
        //获取分类  获取商品  获取轮播图
        $broad_list = db('broad_img')->order('`order`')->select();

        $big_cates = db_func("cate")->where(['type'=>1,'status'=>1])->order("`order` asc")->select();
        $small_cates = db_func("cate")->where(['type'=>2,"status"=>1])->order("`order` asc")->select();
        $goods = db_func("goods")->where(['status'=>1])->order("`order` asc")->select();

        $this->assign('broad_list',$broad_list);
        $this->assign('big_cates',$big_cates);
        $this->assign('small_cates',$small_cates);
        $this->assign('goods',$goods);
		return $this->fetch("index");
	}

    
}