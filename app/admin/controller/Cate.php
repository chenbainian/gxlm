<?php
namespace app\admin\controller;

use think\Controller;

Class Cate extends Common
{

    public function __construct()
    {
        parent::__construct();
    }


    public function cate_list(){
        //获取所有分类
        $condition = [
            'type'=>input('type',''),
            'name'=>input('name',''),
            'status'=>input('status',''),
        ];
        $condition = array_filter($condition);

        $all_cate = db_func('cate')->where($condition)->paginate(20);
        $this->assign('list',$all_cate->all());
        $this->assign('page',$all_cate->render());
        return $this->fetch('cate_list');

    }

    public function see_son_cate(){
        $id = input('id','');
        empty($id) && wrong_return("ID不正确");
        $all_son_cate = db_func("cate")->where(['parent_id'=>$id])->select();
        $this->assign('list',$all_son_cate);
        return $this->fetch('see_son_cate');
    }

    public function update(){
        $id = input('param.id','');
        if(empty($id)) wrong_return("ID不正确");
        $cate_info = db_func("cate")->where(['id'=>$id])->find();
        $this->assign("info",$cate_info);

        $par_cate = db_func("cate")->where(['type'=>1,'status'=>1])->select();
        $this->assign("par_cate",$par_cate);
        return $this->fetch('form');
    }

    public function update_do(){
        if(empty(input('param.id'))){
            wrong_return("分类ID不正确");
        }

        $data = [
            'name'=>input('name',''),
            'status'=>input('status',''),
            'order'=>input('order',''),
            'parent_id'=>input('parent_id','')
        ];
        //检测重复性
        $same_cate = db_func("cate")->where(['name'=>$data['name'],'id'=>["neq",input('param.id')]])->find();
        if($same_cate) wrong_return("分类名已经存在");

        $update_res = db_func("cate")->where(['id'=>input('param.id')])->update($data);
        if($update_res  !== false){
            ok_return("修改成功");
        }
        wrong_return("修改失败");
    }

    public function del_cate(){
        $id = input('param.id','');
        if(empty($id)){
            wrong_return("分类ID不正确");
        }
		$cate_info = db_func("cate")->where(['id'=>$id])->find();
		if(!$cate_info) wrong_return("删除失败");
		if($cate_info['type']==1){
			$son_cate_info = db_func("cate")->where(['status'=>1,'parent_id'=>$id])->select();
			//删除该分类下的商品
			$son_cate_ids = array_column($son_cate_info,'id');
			if($son_cate_ids){
				db_func("goods")->where(['cate_id'=>['in',$son_cate_ids]])->delete();
			}
		}
		
        $del_res= db_func("cate")->where(['id'=>$id])->delete();
        db_func('cate')->where(['parent_id'=>$id])->delete();
		
        if($del_res  !== false){
            ok_return("删除成功");
        }else{
            wrong_return("删除失败");
        }
    }


    public function add(){
        //获取所有父级分类
        $all_par_cate = db_func("cate")->where(['type'=>1])->select();
        $this->assign("par_cate",$all_par_cate);
        return $this->fetch('add_form');
    }

    public function add_do(){
        $data = [
            'name'=>input('name',''),
            'type'=>input('type',''),
            'parent_id'=>input('parent_id',''),
            'status'=>1,
            'order'=>input('order','')
        ];
        empty($data['name']) && wrong_return("分类名称不得为空");
        empty($data['type']) && wrong_return("类型不得为空");
        empty($data['order']) && wrong_return("排序号不得为空");
        if($data['type'] == 2 && empty($data['parent_id'])){
            wrong_return("父级分类不得为空");
        }
        //检测重复性
        $same_cate = db_func("cate")->where(['name'=>$data['name']])->find();
        if($same_cate) wrong_return("分类名已经存在");
        $update_res = db_func("cate")->insert($data);
        if($update_res  !== false){
            ok_return("添加成功");
        }
        wrong_return("添加失败");
    }

    public function big_cates_list(){
        //获取所有的大分类
        $big_cates = db_func("cate")->where(['status'=>1,'type'=>1])->select();
        $this->assign("cates",$big_cates);
        $data = [
            'code'=>200,
            'html'=>$this->fetch("big_cates_list")
        ];
        die_json($data);
    }

    public function small_cates_list(){
        $big_cate_id = input('big_id',1);
        //获取所有的小分类
        $small_cates = db_func("cate")->where(['status'=>1,'type'=>2,'parent_id'=>$big_cate_id])->select();
        $this->assign("cates",$small_cates);
        $data = [
            'code'=>200,
            'html'=>$this->fetch("small_cates_list")
        ];
        die_json($data);
    }
}