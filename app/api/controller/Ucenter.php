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

   /* public function addr(){
        $user_info = get_user_info();
        $this->assign('user_info',$user_info);
        return $this->fetch('addr');
    }*/

    public function order_list(){
        return $this->fetch('order_list');
    }
}