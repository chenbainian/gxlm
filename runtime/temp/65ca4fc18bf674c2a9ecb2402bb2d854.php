<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:30:"./tpl/admin/cate\add_form.html";i:1511265951;s:26:"./tpl/admin/base\base.html";i:1488437847;s:32:"./tpl/admin/base\common_css.html";i:1488437847;s:31:"./tpl/admin/base\common_js.html";i:1488437847;}*/ ?>
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
    <span class="c-gray en">&gt;</span>  分类管理
    <span class="c-gray en">&gt;</span>  新增分类

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
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类名称：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" placeholder="分类名称" name="name">
        </div>
    </div>

    <div class="row cl" >
        <label class="form-label col-xs-4 col-sm-2">分类类型：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <select class="select-box" name="type" id="cate_type">
                <option value="1">顶级分类</option>
                <?php if(!(empty($par_cate) || ($par_cate instanceof \think\Collection && $par_cate->isEmpty()))): ?>
                <option value="2">子级分类</option>
                <?php endif; ?>
            </select>
        </div>
    </div>


    <div class="row cl" style="display: none" id="parent_cate">
        <label class="form-label col-xs-4 col-sm-2">父级分类：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <select class="select-box" name="parent_id">
                <?php if(is_array($par_cate) || $par_cate instanceof \think\Collection): $i = 0; $__LIST__ = $par_cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo (isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:''); ?>"><?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>


    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>排序（越小越在前）：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" placeholder="排序号" name="order">
        </div>
    </div>


    <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
            <button  class="btn btn-warning radius ok_submit" type="button" data-url="<?php echo url('add_do'); ?>">
                <i class="Hui-iconfont">&#xe632;</i>新增
            </button>
            <button onClick="layer_close();" class="btn btn-default radius" type="button">取消</button>
        </div>
    </div>
</form>

</div>



<script>
    $(document).on("change","#cate_type",function(){
        var type = $(this).val();
        if(type == 2){
            //显示
            $("#parent_cate").show();
        }else{
            //不显示
            $("#parent_cate").hide();
        }
    })
</script>

</body>
</html>