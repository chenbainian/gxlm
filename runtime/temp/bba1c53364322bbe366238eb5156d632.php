<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:27:"./tpl/admin/goods/form.html";i:1513234893;s:26:"./tpl/admin/base/base.html";i:1488437847;s:32:"./tpl/admin/base/common_css.html";i:1488437847;s:31:"./tpl/admin/base/common_js.html";i:1488437847;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <LINK rel="Bookmark" href="/favicon.ico" >
    <LINK rel="Shortcut Icon" href="/favicon.ico" />
    
<link rel="stylesheet" type="text/css" href="__hui__/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="__hui_admin__/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="__plugin__/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="__plugin__/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="__plugin__/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="__hui_admin__/skin/default/skin.css" />
<link rel="stylesheet" type="text/css" href="__hui_admin__/css/style.css" />
<link rel="stylesheet" type="text/css" href="__static__/hui/admin/css/style.css" />
<link rel="stylesheet" type="text/css" href="__plugin__/zTree/css/zTreeStyle/zTreeStyle.css" />

<link rel="stylesheet" type="text/css" href="__static__/admin/css/public.css" />

    
    <title>
        
    </title>
</head>
<body>
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 后台
    <span class="c-gray en">&gt;</span>  商品管理
    <span class="c-gray en">&gt;</span>  编辑商品

    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
       href="javascript:location.replace(location.href);" title="刷新">
        <i class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>
<!--插件-->
<script type="text/javascript" src="__plugin__/jquery/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="__plugin__/layer/layer.js"></script>
<script type="text/javascript" src="__plugin__/laydate/laydate.js"></script>
<script type="text/javascript" src="__plugin__/zTree/js/jquery.ztree.core-3.5.min.js"></script>
<script type="text/javascript" src="__plugin__/zTree/js/jquery.ztree.excheck-3.5.min.js"></script>






<!--基础-->
<script type="text/javascript" src="__hui__/js/H-ui.js"></script>
<script type="text/javascript" src="__hui_admin__/js/H-ui.admin.js"></script>

<!--[if lt IE 9]>
<script type="text/javascript" src="__plugin__/html5.min.js"></script>
<script type="text/javascript" src="__plugin__/respond.min.js"></script>
<script type="text/javascript" src="__plugin__/PIE_IE678.js"></script>
<![endif]-->

<!--通用-->
<script type="text/javascript" src="__static__/public/js/common.js"></script>
<script type="text/javascript" src="__static__/admin/js/public.js"></script>


<div class="page-container">
    
<form class="form form-horizontal" id="form-article-add">
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">商品大分类：</label>
        <div class="formControls col-xs-8 col-sm-5">
            <select class="select-box" name="big_cate_id" id="big_cates">

            </select>
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">商品子分类：</label>
        <div class="formControls col-xs-8 col-sm-5">
            <select class="select-box" name="cate_id" id="small_cates">

            </select>
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品名称：</label>
        <div class="formControls col-xs-8 col-sm-5">
            <input type="text" class="input-text" placeholder="商品名称" name="title" value="<?php echo (isset($info['title']) && ($info['title'] !== '')?$info['title']:''); ?>">
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品描述：</label>
        <div class="formControls col-xs-8 col-sm-5">
            <input type="text" class="input-text" placeholder="商品描述" name="desc" value="<?php echo (isset($info['desc']) && ($info['desc'] !== '')?$info['desc']:''); ?>">
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>单位：</label>
        <div class="formControls col-xs-8 col-sm-5">
            <input type="text" class="input-text" placeholder="单位" name="unit" value="<?php echo (isset($info['unit']) && ($info['unit'] !== '')?$info['unit']:''); ?>">
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品库存（数字）：</label>
        <div class="formControls col-xs-8 col-sm-5">
            <input type="text" class="input-text" placeholder="商品库存（数字）" name="num" value="<?php echo (isset($info['num']) && ($info['num'] !== '')?$info['num']:0); ?>">
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品图片：</label>
        <div class="formControls col-xs-8 col-sm-9">

            <!--dom结构部分-->
            <div>
                <!--用来存放item-->
                <div id="imgList" class="img-list"><img src="<?php echo (isset($info['img_src']) && ($info['img_src'] !== '')?$info['img_src']:''); ?>" style="width:200px;height: 200px"></div>
                <div id="img">选择图片</div>
            </div>

        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品介绍1：</label>
        <div class="formControls col-xs-8 col-sm-9">

            <!--dom结构部分-->
            <div>
                <!--用来存放item-->
                <div id="desc_img1List" class="desc_img1-list"><img src="<?php echo (isset($info['desc_img1_src']) && ($info['desc_img1_src'] !== '')?$info['desc_img1_src']:''); ?>" style="width:200px;height: 200px"></div>
                <div id="desc_img1">选择图片</div>
            </div>

        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品介绍2：</label>
        <div class="formControls col-xs-8 col-sm-9">

            <!--dom结构部分-->
            <div>
                <!--用来存放item-->
                <div id="desc_img2List" class="desc_img2-list"><img src="<?php echo (isset($info['desc_img2_src']) && ($info['desc_img2_src'] !== '')?$info['desc_img2_src']:''); ?>" style="width:200px;height: 200px"></div>
                <div id="desc_img2">选择图片</div>
            </div>

        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品介绍3：</label>
        <div class="formControls col-xs-8 col-sm-9">

            <!--dom结构部分-->
            <div>
                <!--用来存放item-->
                <div id="desc_img3List" class="desc_img3-list"><img src="<?php echo (isset($info['desc_img3_src']) && ($info['desc_img3_src'] !== '')?$info['desc_img3_src']:''); ?>" style="width:200px;height: 200px"></div>
                <div id="desc_img3">选择图片</div>
            </div>

        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品介绍4：</label>
        <div class="formControls col-xs-8 col-sm-9">

            <!--dom结构部分-->
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="desc_img4List" class="desc_img4-list"><img src="<?php echo (isset($info['desc_img4_src']) && ($info['desc_img4_src'] !== '')?$info['desc_img4_src']:''); ?>" style="width:200px;height: 200px"></div>
                <div id="desc_img4">选择图片</div>
            </div>

        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>显示价格：</label>
        <div class="formControls col-xs-8 col-sm-5">
            <input type="text" class="input-text" placeholder="显示价格" name="show_price" value="<?php echo (isset($info['show_price']) && ($info['show_price'] !== '')?$info['show_price']:''); ?>">
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>实际价格：</label>
        <div class="formControls col-xs-8 col-sm-5">
            <input type="text" class="input-text" placeholder="实际价格" name="true_price" value="<?php echo (isset($info['true_price']) && ($info['true_price'] !== '')?$info['true_price']:''); ?>">
        </div>
    </div>


    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>排序：</label>
        <div class="formControls col-xs-8 col-sm-5">
            <input type="text" class="input-text" placeholder="排序" name="order" value="<?php echo (isset($info['order']) && ($info['order'] !== '')?$info['order']:''); ?>">
        </div>
    </div>


    <div class="row cl">
        <div class="col-xs-8 col-sm-5 col-xs-offset-4 col-sm-offset-2">
            <button  class="btn btn-warning radius ok_submit" type="button" data-url="<?php echo url('update_do'); ?>">
                <i class="Hui-iconfont">&#xe632;</i>修改
            </button>
            <button onClick="layer_close();" class="btn btn-default radius" type="button">取消</button>
        </div>
    </div>
    <input type="hidden" id="img_src" value="<?php echo (isset($info['img_src']) && ($info['img_src'] !== '')?$info['img_src']:''); ?>" name="img_src">
	<input type="hidden" id="id" value="<?php echo (isset($info['id']) && ($info['id'] !== '')?$info['id']:''); ?>" name="id">
    <input type="hidden" id="desc_img1_src" name="desc_img1_src" value="<?php echo (isset($info['desc_img1_src']) && ($info['desc_img1_src'] !== '')?$info['desc_img1_src']:''); ?>">
    <input type="hidden" id="desc_img2_src" name='desc_img2_src' value="<?php echo (isset($info['desc_img1_src']) && ($info['desc_img1_src'] !== '')?$info['desc_img1_src']:''); ?>">
    <input type="hidden" id="desc_img3_src" name='desc_img3_src' value="<?php echo (isset($info['desc_img1_src']) && ($info['desc_img1_src'] !== '')?$info['desc_img1_src']:''); ?>">
    <input type="hidden" id="desc_img4_src" name='desc_img4_src' value="<?php echo (isset($info['desc_img1_src']) && ($info['desc_img1_src'] !== '')?$info['desc_img1_src']:''); ?>">
</form>
<input type="hidden" id="big_cates_list" value="<?php echo url('admin/cate/big_cates_list'); ?>">
<input type="hidden" id="small_cates_list" value="<?php echo url('admin/cate/small_cates_list'); ?>">
<input type="hidden" id="big_cate_id" value="<?php echo (isset($big_cate_id) && ($big_cate_id !== '')?$big_cate_id:''); ?>">
<input type="hidden" id="small_cate_id" value="<?php echo (isset($info['cate_id']) && ($info['cate_id'] !== '')?$info['cate_id']:''); ?>">




<input type="hidden" id="swf_path" value="__static__/plugin/webuploader/0.1.5/uploader.swf"><!--swf-->
<input type="hidden" id="server_path" value="<?php echo url('admin/goods/up_goods_img'); ?>"><!--上传-->

</div>



<link rel="stylesheet" type="text/css" href="__plugin__/webuploader/0.1.5/webuploader.css" />
<script type="text/javascript" src="__plugin__/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="__static__/admin/js/goods/goods.js"></script>
<script>


    var big_cate_id = $("#big_cate_id").val();
    var small_cate_id = $("#small_cate_id").val();


    var big_cate_url = $("#big_cates_list").val();
    $.common_ajax(big_cate_url,{},function(rt){
        if(rt.code == 200){
            $("#big_cates").html(rt.html);
            if(big_cate_id){
                $("#_"+big_cate_id).attr("selected",true);
            }
        }
    });
	
	 //如果有小分类  绑定小分类选项
    var small_cate_url = $("#small_cates_list").val();
    if(small_cate_id){
        $.common_ajax(small_cate_url,{big_id:big_cate_id},function(rt){
            if(rt.code == 200){
                $("#small_cates").html(rt.html);
                $("#_"+small_cate_id).attr("selected",true);
            }
        });
    }
	
	//加载小分类
    $(document).on("change","#big_cates",function(){
        var url = $("#small_cates_list").val();
        var param = {big_id:$(this).val()};
        $.common_ajax(url,param,function(rt){
           if(rt.code == 200){
               $("#small_cates").html(rt.html);
           }
        });
    });


</script>

</body>
</html>