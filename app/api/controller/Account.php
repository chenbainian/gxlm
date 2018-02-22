<?php
namespace app\api\controller;

use think\Controller;

Class Account extends Common
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        if(is_user_login()){
            $this->redirect('index/index');
        }
        return $this->fetch('index');
    }

    public function login_do(){
        if(is_user_login()){
            ok_return("登录成功");
        }
        $username = input('username','');
        $password = input('password','');
        $user_info = db_func('users')->where(['username'=>$username,'status'=>1])->find();
        if(!$user_info || md6($password) != $user_info['password']){
            wrong_return("用户名或密码不正确");
        }
        $user_info['last_login_time'] = time();
        $user_info['last_login_ip'] = get_client_ip_true();
        db('users')->update($user_info);
        session('user',$user_info);
        ok_return("登录成功");
    }

    public function quit(){
        session('user',null);
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