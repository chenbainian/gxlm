<?php
namespace app\api\controller;

use think\Controller;

Class Ucenter extends Common
{

    public function __construct()
    {
        parent::__construct();
    }

	public function index(){
        $user_info = get_user_info();
        $this->assign('user_info',$user_info);
		return $this->fetch('index');
	}

    public function addr(){
        $user_info = get_user_info();
        $this->assign('user_info',$user_info);
        return $this->fetch('addr');
    }

    public function order_list(){
        $status = input('status','');
        $condition = [
            'user_id'=>get_user_id(),
            'status'=>$status
        ];
        $condition = array_filter($condition);
        $order_list = db_func('order')->where($condition)->paginate(1);
        $this->assign('list',$order_list->all());
        $this->assign('pages',preg_page($order_list->render()));
        return $this->fetch('order_list');
    }
}