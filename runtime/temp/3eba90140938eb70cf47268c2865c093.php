<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:33:"./tpl/admin/order/order_list.html";i:1511958957;s:26:"./tpl/admin/base/base.html";i:1488437847;s:32:"./tpl/admin/base/common_css.html";i:1488437847;s:31:"./tpl/admin/base/common_js.html";i:1488437847;}*/ ?>
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
    <span class="c-gray en">&gt;</span>  订单管理
    <span class="c-gray en">&gt;</span>  订单列表
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

    <form id="form_condition" class="form-search" method="get">

        <div class="text-c"> 名称搜索：

            <input type="text" class="input-text" style="width:150px" placeholder="请输入用户名称"  name="nick_name" value="<?php echo input('param.nick_name',''); ?>">
            <input type="text" class="input-text" style="width:150px" placeholder="请输入订单名称"  name="order_name" value="<?php echo input('param.order_name',''); ?>">
            <input type="text" class="input-text" style="width:100px" placeholder="请输入订单ID"  name="order_id" value="<?php echo input('param.order_id',''); ?>">
            <select class="form-control " name="status" style="height:31px;width:100px ">
                <option value="">状态</option>
                <option <?php if(input('param.status','') == '1'): ?> selected='selected'<?php endif; ?> value="1">待确认</option>
                <option <?php if(input('param.status','') == '2'): ?> selected='selected'<?php endif; ?> value="2">已确认待发货</option>
                <option <?php if(input('param.status','') == '3'): ?> selected='selected'<?php endif; ?> value="1">已发货 待收货 </option>
                <option <?php if(input('param.status','') == '4'): ?> selected='selected'<?php endif; ?> value="2">已确认收货</option>
                <option <?php if(input('param.status','') == '5'): ?> selected='selected'<?php endif; ?> value="1">异常</option>
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
            <th width="10">ID</th>
            <th width="60">用户名</th>
            <th width="60">订单名称</th>
            <th width="60">订单ID</th>
            <th width="30">价格</th>
            <th width="30">实收价格</th>
            <th width="30">子订单数量</th>
            <th width="60">状态</th>
            <th width="60">创建时间</th>
            <th width="50">订单结束时间</th>
            <th width="50">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(empty($list) || ($list instanceof \think\Collection && $list->isEmpty())): ?>
        <tr>
            <td class="text-c" colspan="13">暂无数据..</td>
        </tr>
        <?php else: if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr class="text-c">
            <td><?php echo (isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:''); ?></td>
            <td><?php echo (isset($vo['nick_name']) && ($vo['nick_name'] !== '')?$vo['nick_name']:''); ?></td>
            <td><?php echo (isset($vo['order_name']) && ($vo['order_name'] !== '')?$vo['order_name']:''); ?></td>
            <td><?php echo (isset($vo['order_id']) && ($vo['order_id'] !== '')?$vo['order_id']:''); ?></td>
            <td><?php echo (isset($vo['price']) && ($vo['price'] !== '')?$vo['price']:''); ?></td>
            <td><?php echo (isset($vo['true_price']) && ($vo['true_price'] !== '')?$vo['true_price']:''); ?></td>
            <td><?php echo (isset($vo['sub_order_num']) && ($vo['sub_order_num'] !== '')?$vo['sub_order_num']:''); ?></td>
            <td>
                <?php if(!(empty($vo['status']) || ($vo['status'] instanceof \think\Collection && $vo['status']->isEmpty()))): switch($vo['status']): case "1": ?><span class="label label-success radius">待确认</span><?php break; case "2": ?><span class="label label-info radius">已确认待发货</span><?php break; case "3": ?><span class="label label-success radius">已发货 待收货</span><?php break; case "4": ?><span class="label label-info radius">已确认收货</span><?php break; case "5": ?><span class="label label-success radius">异常</span><?php break; default: ?>--
                <?php endswitch; endif; ?>
            </td>

            <td><?php if(!(empty($vo['create_time']) || ($vo['create_time'] instanceof \think\Collection && $vo['create_time']->isEmpty()))): ?><?php echo date('Y-m-d H:i:s',$vo['create_time']); else: endif; ?></td>
            <td><?php if(!(empty($vo['stop_time']) || ($vo['stop_time'] instanceof \think\Collection && $vo['stop_time']->isEmpty()))): ?><?php echo date('Y-m-d H:i:s',$vo['stop_time']); else: ?>未结束<?php endif; ?></td>
            <td class="td-manage">
                <input class="btn btn-secondary radius open_form"  data-url="<?php echo url('update_order',['id'=>$vo['id']]); ?>" type="button" value="查看编辑">
                <input class="btn btn-secondary radius open_form"  data-url="<?php echo url('sub_order_list',['id'=>$vo['id']]); ?>" type="button" value="查看子订单">
                <?php switch($vo['status']): case "1": ?>
                    <input class="btn btn-danger radius update_status"  data-id="<?php echo (isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:''); ?>" type="button" value="确认订单">
                    <?php break; case "2": ?>
                    <input class="btn btn-danger radius update_status"  data-id="<?php echo (isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:''); ?>" type="button" value="确认发货">
                    <?php break; case "3": ?>
                    <input class="btn btn-danger radius update_status"  data-id="<?php echo (isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:''); ?>" type="button" value="确认收货">
                    <?php break; endswitch; ?>
                <input class="btn btn-danger radius del_order" data-id="<?php echo (isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:0); ?>" type="button" value="删除">
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </tbody>
    </table>
</div>


<nav class="page_admin">
    <?php echo (isset($page) && ($page !== '')?$page:''); ?>
</nav>
<input type="hidden" id="del_order" value="<?php echo url('admin/order/del_order'); ?>">

</div>



<script>
    $(".del_order").click(function(){
        var url = $("#del_order").val();
        var id = $(this).data('id');
        layer.confirm("您确定要删除该订单和下面子订单?",{
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

</script>

</body>
</html>