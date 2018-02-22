<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:33:"./tpl/admin/goods/goods_list.html";i:1512224222;s:26:"./tpl/admin/base/base.html";i:1488437847;s:32:"./tpl/admin/base/common_css.html";i:1488437847;s:31:"./tpl/admin/base/common_js.html";i:1488437847;}*/ ?>
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
    <span class="c-gray en">&gt;</span>  商品列表
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
    <a class="btn btn-primary radius open_form" data-title="商品管理->添加商品" data-url="<?php echo url('add'); ?>" href="javascript:;">
        <i class="Hui-iconfont">&#xe600;</i> 添加商品</a>
    </span>

    <form id="form_condition" class="form-search" method="get">

        <div class="text-c"> 商品大分类：
            <select class="form-control " name="big_cate_id" style="height:31px;width:100px " id="big_cates">

            </select>
            商品小分类：
            <select class="form-control " name="small_cate_id" style="height:31px;width:100px" id="small_cates">

            </select>
            状态：
            <select class="form-control " name="status" style="height:31px;width:100px ">
                <option value="">状态</option>
                <option <?php if(input('param.status','') == '1'): ?> selected='selected'<?php endif; ?> value="1">显示</option>
                <option <?php if(input('param.status','') == '2'): ?> selected='selected'<?php endif; ?> value="2">不显示</option>
            </select>
            <input type="text" class="input-text" style="width:150px" placeholder="请输入商品名称"  name="title" value="<?php echo input('param.title',''); ?>">
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
            <th width="50">商品名</th>
            <th width="40">描述</th>
            <th width="80">状态</th>
            <th width="80">分类</th>
            <th width="20">商品缩略图</th>
            <th width="40">显示价格</th>
            <th width="40">实际价格</th>
            <th width="40">库存</th>
            <th width="80">单位</th>
            <th width="80">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(empty($list) || ($list instanceof \think\Collection && $list->isEmpty())): ?>
        <tr>
            <td class="text-c" colspan="11">暂无数据..</td>
        </tr>
        <?php else: if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr class="text-c">
            <td><?php echo (isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:''); ?></td>
            <td><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></td>
            <td><?php echo (isset($vo['desc']) && ($vo['desc'] !== '')?$vo['desc']:''); ?></td>
            <td>
                <?php if(!(empty($vo['status']) || ($vo['status'] instanceof \think\Collection && $vo['status']->isEmpty()))): switch($vo['status']): case "1": ?><span class="label label-success radius">显示</span><?php break; case "2": ?><span class="label label-info radius">不显示</span><?php break; default: ?>--
                <?php endswitch; endif; ?>
            </td>
            <td><?php echo (isset($vo['cate_name']) && ($vo['cate_name'] !== '')?$vo['cate_name']:''); ?></td>
            <td><img src="<?php echo $vo['img_src']; ?>" style="width: 80px;height: 80px;"></td>
            <td><?php echo (isset($vo['show_price']) && ($vo['show_price'] !== '')?$vo['show_price']:0); ?></td>
            <td><?php echo (isset($vo['true_price']) && ($vo['true_price'] !== '')?$vo['true_price']:0); ?></td>
            <td><?php echo (isset($vo['num']) && ($vo['num'] !== '')?$vo['num']:0); ?></td>
            <td><?php echo (isset($vo['unit']) && ($vo['unit'] !== '')?$vo['unit']:0); ?></td>
            <td class="td-manage">
                <input class="btn btn-secondary radius open_form"  data-url="<?php echo url('update',['id'=>$vo['id'],'type'=>'edit']); ?>" type="button" value="编辑">
                <input class="btn btn-danger radius del_goods" data-type="<?php echo (isset($vo['type']) && ($vo['type'] !== '')?$vo['type']:1); ?>" data-id="<?php echo (isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:0); ?>" type="button" value="删除">
                <?php if($vo['status'] == 2): ?>
                <input class="btn btn-secondary radius unforbid"  data-id="<?php echo (isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:''); ?>" type="button" value="启用">
                <?php else: ?>
                <input class="btn btn-danger radius forbid" data-id="<?php echo (isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:''); ?>"  type="button" value="禁用">
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </tbody>
    </table>
</div>


<nav class="page_admin">
    <?php echo (isset($page) && ($page !== '')?$page:''); ?>
</nav>
<input type="hidden" id="del_goods" value="<?php echo url('admin/goods/del_goods'); ?>">
<input type="hidden" id="forbid_goods" value="<?php echo url('admin/goods/forbid'); ?>">
<input type="hidden" id="unforbid_goods" value="<?php echo url('admin/goods/unforbid'); ?>">
<input type="hidden" id="big_cates_list" value="<?php echo url('admin/cate/big_cates_list'); ?>">
<input type="hidden" id="small_cates_list" value="<?php echo url('admin/cate/small_cates_list'); ?>">

<input type="hidden" id="big_cate_id" value="<?php echo input('param.big_cate_id',''); ?>">
<input type="hidden" id="small_cate_id" value="<?php echo input('param.small_cate_id',''); ?>">

</div>



<script>
    $(".del_goods").click(function(){
        var url = $("#del_goods").val();
        var id = $(this).data('id');
        layer.confirm("您确定要删除该商品?",{
            btn:["确定","取消"]
        },function(){
            $.common_ajax(url,{id:id},function(rt){
                layer.msg(rt.msg);
                if(rt.code == 1){
                    location.reload();
                }
            })
        });
    });

    $(".forbid").click(function(){
        var url = $("#forbid_goods").val();
        var id = $(this).data('id');
        $.common_ajax(url,{id:id},function(rt){
            layer.msg(rt.msg);
            if(rt.code == 1){
                location.reload();
            }
        })
    });

    $(".unforbid").click(function(){
        var url = $("#unforbid_goods").val();
        var id = $(this).data('id');
        $.common_ajax(url,{id:id},function(rt){
            layer.msg(rt.msg);
            if(rt.code == 1){
                location.reload();
            }
        })
    });

    //加载大分类  绑定大分类选项
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
    })
</script>

</body>
</html>