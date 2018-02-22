<?php
namespace app\admin\controller;

use think\Controller;

Class Account extends Common
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        return $this->fetch('index');
    }

    public function login_do(){
        $username = input('user_login','');
        $password = input('user_pass','');
        $admin_info = db_func('admin_users')->where(['login_name'=>$username])->find();
        if(!$admin_info || md6($password) != $admin_info['password']){
            wrong_return("用户名或密码不正确");
        }
        session('admin',$admin_info);
        db('admin_users')->where(['id'=>$admin_info['id']])->update(['last_login_ip'=>get_client_ip_true(),'last_login_time'=>time()]);
        ok_return("登录成功");
    }

    public function quit(){
        session(null);
        ok_return("退出成功，请重新登录");
    }

    public function change_password(){
        $password = input('password','');
        if(empty($password)){
            wrong_return("密码不得为空");
        }
        $new_password = md6($password);
        $admin_id = get_admin_id();
        $res = db_func("admin_users")->where(['id'=>$admin_id])->update(['password'=>$new_password]);
        if($res!= false){
            ok_return("修改成功");
        }else{
            wrong_return("修改失败");
        }
    }
}