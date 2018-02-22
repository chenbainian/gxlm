<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:31:"./tpl/admin/broad\add_form.html";i:1513236565;s:26:"./tpl/admin/base\base.html";i:1488437847;s:32:"./tpl/admin/base\common_css.html";i:1488437847;s:31:"./tpl/admin/base\common_js.html";i:1488437847;}*/ ?>
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
    <span class="c-gray en">&gt;</span>  轮播图管理
    <span class="c-gray en">&gt;</span>  编辑轮播图

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
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>轮播图片：</label>
        <div class="formControls col-xs-8 col-sm-9">

            <!--dom结构部分-->
            <div>
                <!--用来存放item-->
                <div id="imgList" class="img-list"><img src="" style="width:200px;height: 200px"></div>
                <div id="img">选择图片</div>
            </div>

        </div>
    </div>


    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>排序：</label>
        <div class="formControls col-xs-8 col-sm-5">
            <input type="text" class="input-text" placeholder="排序" name="order" value="">
        </div>
    </div>


    <div class="row cl">
        <div class="col-xs-8 col-sm-5 col-xs-offset-4 col-sm-offset-2">
            <button  class="btn btn-warning radius ok_submit" type="button" data-url="<?php echo url('add_do'); ?>">
                <i class="Hui-iconfont">&#xe632;</i>添加
            </button>
            <button onClick="layer_close();" class="btn btn-default radius" type="button">取消</button>
        </div>
    </div>
    <input type="hidden" id="img_src" value="<?php echo (isset($info['img_src']) && ($info['img_src'] !== '')?$info['img_src']:''); ?>" name="img_src">

</form>

<input type="hidden" id="swf_path" value="__static__/plugin/webuploader/0.1.5/uploader.swf"><!--swf-->
<input type="hidden" id="server_path" value="<?php echo url('admin/goods/up_goods_img'); ?>"><!--上传-->

</div>



<link rel="stylesheet" type="text/css" href="__plugin__/webuploader/0.1.5/webuploader.css" />
<script type="text/javascript" src="__plugin__/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="__static__/admin/js/broad/broad.js"></script>

</body>
</html>