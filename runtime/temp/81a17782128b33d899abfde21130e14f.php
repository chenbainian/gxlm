<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:31:"./tpl/admin/cate/cate_list.html";i:1511348506;s:26:"./tpl/admin/base/base.html";i:1488437847;s:32:"./tpl/admin/base/common_css.html";i:1488437847;s:31:"./tpl/admin/base/common_js.html";i:1488437847;}*/ ?>
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
    <span class="c-gray en">&gt;</span>  分类
    <span class="c-gray en">&gt;</span>  分类列表
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
    

<div class="cl pd-5 bg-1 bk-gray mt-20">
    <span class="l">
    <a class="btn btn-primary radius open_form" data-title="分类管理->添加分类" data-url="<?php echo url('add'); ?>" href="javascript:;">
        <i class="Hui-iconfont">&#xe600;</i> 添加分类</a>
    </span>

    <form id="form_condition" class="form-search" method="get">

        <div class="text-c"> 名称搜索：

            <input type="text" class="input-text" style="width:250px" placeholder="请输入分类名" id="" name="name" value="<?php echo input('param.name',''); ?>">
            <select class="form-control " name="status" style="height:31px;width:100px ">
                <option value="">状态</option>
                <option <?php if(input('param.status','') == '1'): ?> selected='selected'<?php endif; ?> value="1">正常</option>
                <option <?php if(input('param.status','') == '2'): ?> selected='selected'<?php endif; ?> value="2">禁用</option>
            </select>
            <select class="form-control " name="type" style="height:31px;width:100px ">
                <option value="">类型</option>
                <option <?php if(input('param.type','') == '1'): ?> selected='selected'<?php endif; ?> value="1">顶级分类</option>
                <option <?php if(input('param.type','') == '2'): ?> selected='selected'<?php endif; ?> value="2">子级分类</option>
            </select>
            <button type="submit" class="btn btn-success " name=""><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
            <button type="submit" class="btn btn-default" onclick="$('input[name=\'search_word\']').val('')"  name=""><i class="fa fa-times"></i> 清空搜索</button>
        </div>
    </form>
</div>
<div class="mt-20">
    <table class="table table-border table-bordered table-bg table-hover table-sort">
        <thead>
        <tr class="text-c">
            <th width="30">ID</th>
            <th width="50">名称</th>
            <th width="50">状态</th>
            <th width="20">类型</th>
            <th width="60">缩略图</th>
            <th width="80">排序</th>
            <th width="20">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(empty($list) || ($list instanceof \think\Collection && $list->isEmpty())): ?>
        <tr>
            <td class="text-c" colspan="7">暂无数据..</td>
        </tr>
        <?php else: if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr class="text-c">
            <td><?php echo (isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:''); ?></td>
            <td><?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?></td>
            <td>
                <?php if(!(empty($vo['status']) || ($vo['status'] instanceof \think\Collection && $vo['status']->isEmpty()))): switch($vo['status']): case "1": ?><span class="label label-success radius">正常</span><?php break; case "2": ?><span class="label label-info radius">禁用</span><?php break; default: ?>状态异常
                <?php endswitch; endif; ?>
            </td>
            <td>
                <?php if(!(empty($vo['type']) || ($vo['type'] instanceof \think\Collection && $vo['type']->isEmpty()))): switch($vo['type']): case "1": ?><span class="label label-success radius">顶级分类</span><?php break; case "2": ?><span class="label label-info radius">子级分类</span><?php break; default: ?>状态异常
                <?php endswitch; endif; ?>
            </td>
            <td>
                <img src="<?php echo $vo['img_src']; ?>" width="70px" height="70px">
            </td>
            <td><?php echo (isset($vo['order']) && ($vo['order'] !== '')?$vo['order']:''); ?></td>
            <td>
                <input class="btn btn-secondary radius open_form"  data-url="<?php echo url('update',['id'=>$vo['id'],'type'=>'edit']); ?>" type="button" value="编辑">
                <input class="btn btn-danger radius del_cate" data-type="<?php echo (isset($vo['type']) && ($vo['type'] !== '')?$vo['type']:1); ?>" data-id="<?php echo (isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:0); ?>" type="button" value="删除">
                <?php if($vo['type'] == 1): ?>
                <input class="btn btn-danger radius see_sons open_form" data-url="<?php echo url('see_son_cate',['id'=>$vo['id'],'type'=>'edit']); ?>" type="button" value="查看子分类">
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </tbody>
    </table>
</div>
<input type="hidden" id="del_cate" value="<?php echo url('admin/cate/del_cate'); ?>">
<nav class="page_admin">
    <?php echo (isset($page) && ($page !== '')?$page:''); ?>
</nav>

</div>



<script>
    $(".del_cate").click(function(){
        var url = $("#del_cate").val();
        var id = $(this).data('id');
        var type = $(this).data('type');
        var msg;
        if(type == 1){
            msg = "您确定要删除该分类及下面子分类?";
        }else{
            msg = "您确定要删除该分类?";
        }
        layer.confirm(msg,{
            btn:["确定","取消"]
        },function(){
            $.common_ajax(url,{id:id},function(rt){
                layer.msg(rt.msg);
                if(rt.code == 1){
                    location.reload();
                }
            })
        });


    })
</script>

</body>
</html>