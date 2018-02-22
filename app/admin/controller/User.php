<?php
namespace app\admin\controller;

use think\Controller;

Class User extends Common
{

    public function __construct()
    {
        parent::__construct();
    }

    public function user_list(){
        //获取所有用户
        $condition = [
            'nick_name'=>input('nick_name',''),
            'status'=>input('status',''),
            'type'=>input('type',''),
            'phone'=>input('phone',''),
            'province'=>input('province',''),
            'city'=>input('city',''),
            'area'=>input('area',''),
        ];
        $condition = array_filter($condition);

        $all_user_user = db_func('users')->where($condition)->paginate(20);
        $this->assign('list',$all_user_user->all());
        $this->assign('page',$all_user_user->render());
        return $this->fetch('user_list');

    }

    public function update(){
        $id = input('param.id','');
        if(empty($id)) wrong_return("ID不正确");
        $user_info = db_func("users")->where(['id'=>$id])->find();
        $this->assign("info",$user_info);
        return $this->fetch('form');
    }

    public function update_do(){
        if(empty(input('param.id'))){
            wrong_return("用户ID不正确");
        }

        $data = [
            'nick_name'=>input('nick_name',''),
            'username'=>input('username',''),
            'password'=>input('password',''),
            'type'=>input('type',''),
            'phone'=>input('phone',''),
            'province'=>input('province',''),
            'city'=>input('city',''),
            'area'=>input('area',''),
            'addr'=>input('addr',''),
            'remark'=>input('remark',''),
        ];

        empty($data['nick_name']) && wrong_return("用户名称不得为空");
        empty($data['username']) && wrong_return("登陆名不得为空");
        empty($data['type']) && wrong_return("类型不得为空");
        empty($data['phone']) && wrong_return("联系方式不得为空");
        empty($data['province']) && wrong_return("省份不得为空");
        empty($data['city']) && wrong_return("城市不得为空");
        empty($data['area']) && wrong_return("区域不得为空");
        empty($data['addr']) && wrong_return("地址不得为空");

        if(!empty($data['password'])){
            $data['password'] = md6($data['password']);
        }
        //检测重复性
        $same_user = db_func("users")->where(['username'=>$data['username'],'id'=>["neq",input('param.id')]])->find();
        if($same_user) wrong_return("登录名已经存在");
        $same_user = db_func("users")->where(['nick_name'=>$data['nick_name'],'id'=>["neq",input('param.id')]])->find();
        if($same_user) wrong_return("用户名称已经存在");

        $update_res = db_func("users")->where(['id'=>input('param.id')])->update($data);
        if($update_res !== false){
            ok_return("修改成功");
        }
        wrong_return("修改失败");
    }

    public function del_user(){
        $id = input('param.id','');
        if(empty($id)){
            wrong_return("用户ID不正确");
        }
        $del_res= db_func("users")->where(['id'=>$id])->delete();
        if($del_res  !== false){
            ok_return("删除成功");
        }else{
            wrong_return("删除失败");
        }
    }

    public function forbid(){
        $id = input('param.id','');
        if(empty($id)){
            wrong_return("用户ID不正确");
        }
        $del_res= db_func("users")->where(['id'=>$id])->update(['status'=>2]);
        if($del_res  !== false){
            ok_return("禁用成功");
        }else{
            wrong_return("禁用失败");
        }
    }

    public function unforbid(){
        $id = input('param.id','');
        if(empty($id)){
            wrong_return("用户ID不正确");
        }
        $del_res= db_func("users")->where(['id'=>$id])->update(['status'=>1]);
        if($del_res  !== false){
            ok_return("启用成功");
        }else{
            wrong_return("启用失败");
        }
    }

    public function add(){
        return $this->fetch('add_form');
    }

    public function add_do(){
        $data = [
            'nick_name'=>input('nick_name',''),
            'username'=>input('username',''),
            'password'=>input('password',''),
            'type'=>input('type',''),
            'phone'=>input('phone',''),
            'province'=>input('province',''),
            'city'=>input('city',''),
            'area'=>input('area',''),
            'addr'=>input('addr',''),
            'remark'=>input('type',''),
        ];
        empty($data['nick_name']) && wrong_return("用户名称不得为空");
        empty($data['username']) && wrong_return("登陆名不得为空");
        empty($data['password']) && wrong_return("密码不得为空");
        empty($data['type']) && wrong_return("类型不得为空");
        empty($data['phone']) && wrong_return("联系方式不得为空");
        empty($data['province']) && wrong_return("省份不得为空");
        empty($data['city']) && wrong_return("城市不得为空");
        empty($data['area']) && wrong_return("区域不得为空");
        empty($data['addr']) && wrong_return("地址不得为空");

        $data['password'] = md6($data['password']);
        $data['create_time'] = time();
        $data['update_time'] = time();
        //检测重复性
        $same_user = db_func("users")->where(['username'=>$data['username']])->find();
        if($same_user) wrong_return("登录名已经存在");
        $same_user = db_func("users")->where(['nick_name'=>$data['nick_name']])->find();
        if($same_user) wrong_return("用户名称已经存在");

        $update_res = db_func("users")->insert($data);
        if($update_res  !== false){
            ok_return("添加成功");
        }
        wrong_return("添加失败");
    }
}