<?php
namespace app\admin\controller;

use think\Controller;

Class Goods extends Common
{

    public function __construct()
    {
        parent::__construct();
    }

    public function goods_list(){
        //获取所有商品
        $condition = [
            'big_cate_id'=>input('big_cate_id',''),
            'cate_id'=>input('cate_id',''),
            'title'=>input('title',''),
            'status'=>input('status',''),
        ];
        $condition = array_filter($condition);
		//连表查小分类
        $all_admin_user = db_func('goods g')
									->field('g.*,c.name as cate_name')
									->join("cate c",'c.id = g.cate_id','left')
									->where($condition)
									->paginate(20);
        $this->assign('list',$all_admin_user->all());
        $this->assign('page',$all_admin_user->render());
        return $this->fetch('goods_list');

    }

    public function add(){
        return $this->fetch('add_form');
    }

    public function add_do(){
        $data = [
            'title'=>input('title',''),
            'desc'=>input('desc',''),
            'img_src'=>input('img_src',''),
            'show_price'=>floatval(input('show_price',0)),
            'true_price'=>floatval(input('true_price',0)),
            'num'=>intval(input('num',0)),
            'unit'=>input('unit','个'),
            'order'=>intval(input('order','')),
            'cate_id'=>intval(input('cate_id','')),
            'big_cate_id'=>intval(input("big_cate_id",'')),
            'status'=>1,
            'desc_img1_src'=>input('desc_img1_src',''),
            'desc_img2_src'=>input('desc_img2_src',''),
            'desc_img3_src'=>input('desc_img3_src',''),
            'desc_img4_src'=>input('desc_img4_src',''),
            'true_sales_num'=>0,
            'show_sales_num'=>input('true_sales_num',0)
        ];
        empty($data['title']) && wrong_return("商品名不得为空");
        empty($data['desc']) && wrong_return("商品描述不得为空");
        empty($data['img_src']) && wrong_return("商品图片不得为空");
        empty($data['show_price']) && wrong_return("显示价格不得为空");
        empty($data['true_price']) && wrong_return("真实价格不得为空");
        empty($data['num']) && wrong_return("库存不得为空");
        empty($data['unit']) && wrong_return("单位不得为空");
        empty($data['order']) && wrong_return("排序号不得为空");
        empty($data['cate_id']) && wrong_return("分类不得为空");
        empty($data['big_cate_id']) && wrong_return("大分类不得为空");

        //检测重复性
        $same_goods = db_func("goods")->where(['title'=>$data['title']])->find();
        if($same_goods) wrong_return("商品已经存在");


        $update_res = db_func("goods")->insert($data);
        if($update_res){
            ok_return("添加成功");
        }
        wrong_return("添加失败");
    }

    public function update(){

        $id = input('param.id','');
        if(empty($id)) wrong_return("ID不正确");
        $goods_info = db_func("goods")->where(['id'=>$id])->find();
		//查询商品分类
		$big_cate_id = db_func("cate")->where(['id'=>$goods_info['cate_id']])->find();
	
		$this->assign('big_cate_id',$big_cate_id['parent_id']);
        $this->assign("info",$goods_info);
        return $this->fetch('form');
    }

    public function update_do(){
		$id = input("param.id",'');
		empty($id) && wrong_return("商品id不正确");
       $data = [
            'title'=>input('title',''),
            'desc'=>input('desc',''),
            'img_src'=>input('img_src',''),
            'show_price'=>floatval(input('show_price',0)),
            'true_price'=>floatval(input('true_price',0)),
            'num'=>intval(input('num',0)),
            'unit'=>input('unit','个'),
            'order'=>intval(input('order','')),
            'cate_id'=>intval(input('cate_id','')),
            'big_cate_id'=>intval(input('big_cate_id','')),
            'desc_img1_src'=>input('desc_img1_src',''),
            'desc_img2_src'=>input('desc_img2_src',''),
            'desc_img3_src'=>input('desc_img3_src',''),
            'desc_img4_src'=>input('desc_img4_src',''),
            'show_sales_num'=>input('show_sales_num',0),
        ];
        empty($data['title']) && wrong_return("商品名不得为空");
        empty($data['desc']) && wrong_return("商品描述不得为空");
        empty($data['img_src']) && wrong_return("商品图片不得为空");
        empty($data['show_price']) && wrong_return("显示价格不得为空");
        empty($data['true_price']) && wrong_return("真实价格不得为空");
        empty($data['num']) && wrong_return("库存不得为空");
        empty($data['unit']) && wrong_return("单位不得为空");
        empty($data['order']) && wrong_return("排序号不得为空");
        empty($data['cate_id']) && wrong_return("分类不得为空");
        empty($data['big_cate_id']) && wrong_return("大分类不得为空");
        $update_res = db_func("goods")->where(['id'=>$id])->update($data);
		
        if($update_res !== false){
            ok_return("修改成功");
        }
        wrong_return("修改失败");
    }

    public function del_goods(){
        $id = input('param.id','');
        if(empty($id)){
            wrong_return("商品ID不正确");
        }
        $del_res= db_func("goods")->where(['id'=>$id])->delete();
        if($del_res  !== false){
            ok_return("删除成功");
        }else{
            wrong_return("删除失败");
        }
    }

    public function forbid(){
        $id = input('param.id','');
        if(empty($id)){
            wrong_return("商品ID不正确");
        }
        $del_res= db_func("goods")->where(['id'=>$id])->update(['status'=>2]);
        if($del_res  !== false){
            ok_return("禁用成功");
        }else{
            wrong_return("禁用失败");
        }
    }

    public function unforbid(){
        $id = input('param.id','');
        if(empty($id)){
            wrong_return("商品ID不正确");
        }
        $del_res= db_func("goods")->where(['id'=>$id])->update(['status'=>1]);
        if($del_res  !== false){
            ok_return("启用成功");
        }else{
            wrong_return("启用失败");
        }
    }

    public function up_goods_img()
    {
        // 指定允许其他域名访问
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:POST');
        header('Access-Control-Allow-Headers:x-requested-with,content-type');

        //裁剪信息

        $config = array(
            // 允许上传的文件MiMe类型
            'mimes' => [],
            // 上传的文件大小限制 (0-不做限制)
            'maxSize' => 2014000,
            // 允许上传的文件后缀
            'exts' => ['jpg', 'gif', 'png', 'jpeg', 'bmp'],
            // 自动子目录保存文件
            'autoSub' => true,
            // 子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
            'subName' => ['date', 'ymd'],
            //保存根路径
            'rootPath' => './public/data/img/',
            // 保存路径
            'savePath' => '',
            // 上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
            'saveName' => ['uniqid', ''],
            // 文件保存后缀，空则使用原后缀
            'saveExt' => '',
            // 存在同名是否覆盖
            'replace' => true,
            // 是否生成hash编码
            'hash' => true,
            // 检测文件是否存在回调，如果存在返回文件信息数组
            'callback' => false,
            // 文件上传驱动e,
            'driver' => '',
            // 上传驱动配置
            'driverConfig' => ["Local"],
        );
        $upload = new \org\Upload($config, 'LOCAL');// 实例化上传类
        $post = $upload->upload();
        $post = $post['file'];
        $post['img_path'] = $post['savepath'] . $post['savename'];
        $img_path = $config['rootPath'] . $post['img_path'];

        /*保存后如果有裁剪标记则进行裁剪*/
        if (empty($post['img_path'])) {
            wrong_return("上传失败");
        }

        $filePath = $config['rootPath'] . trim($post['img_path'], "/");

        $data = [
            'code'=>200,
            'img_path'=> trim($img_path,"."),
            'file_path'=>$filePath

        ];
        die_json($data);
    }


}