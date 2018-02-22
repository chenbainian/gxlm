<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:31:"./tpl/admin/user/user_list.html";i:1511515193;s:26:"./tpl/admin/base/base.html";i:1488437847;s:32:"./tpl/admin/base/common_css.html";i:1488437847;s:31:"./tpl/admin/base/common_js.html";i:1488437847;}*/ ?>
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
    <span class="c-gray en">&gt;</span>  用户管理
    <span class="c-gray en">&gt;</span>  用户列表
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
    <a class="btn btn-primary radius open_form" data-title="用户管理->添加用户" data-url="<?php echo url('add'); ?>" href="javascript:;">
        <i class="Hui-iconfont">&#xe600;</i> 添加用户</a>
    </span>

    <form id="form_condition" class="form-search" method="get">

        <div class="text-c"> 名称搜索：

            <input type="text" class="input-text" style="width:150px" placeholder="请输入用户名称"  name="nick_name" value="<?php echo input('param.nick_name',''); ?>">
            <input type="text" class="input-text" style="width:150px" placeholder="请输入联系方式"  name="phone" value="<?php echo input('param.phone',''); ?>">
            <input type="text" class="input-text" style="width:100px" placeholder="请输入省份"  name="province" value="<?php echo input('param.province',''); ?>">
            <input type="text" class="input-text" style="width:100px" placeholder="请输入城市"  name="city" value="<?php echo input('param.city',''); ?>">
            <input type="text" class="input-text" style="width:100px" placeholder="请输入区域"  name="area" value="<?php echo input('param.area',''); ?>">
            <select class="form-control " name="status" style="height:31px;width:100px ">
                <option value="">状态</option>
                <option <?php if(input('param.status','') == '1'): ?> selected='selected'<?php endif; ?> value="1">正常</option>
                <option <?php if(input('param.status','') == '2'): ?> selected='selected'<?php endif; ?> value="2">禁用</option>
            </select>
            <select class="form-control " name="type" style="height:31px;width:100px ">
                <option value="">类型</option>
                <option <?php if(input('param.type','') == '1'): ?> selected='selected'<?php endif; ?> value="1">初级会员</option>
                <option <?php if(input('param.type','') == '2'): ?> selected='selected'<?php endif; ?> value="2">高级会员</option>
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
            <th width="50">登录用户名</th>
            <th width="40">用户名</th>
            <th width="20">状态</th>
            <th width="40">总订单数</th>
            <th width="40">总订单钱数</th>
            <th width="40">类型</th>
            <th width="80">联系方式</th>
            <th width="80">上次登录时间</th>
            <th width="40">省份</th>
            <th width="40">城市</th>
            <th width="40">区域</th>
            <th width="40">地址</th>
            <th width="20">备注</th>
            <th width="80">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(empty($list) || ($list instanceof \think\Collection && $list->isEmpty())): ?>
        <tr>
            <td class="text-c" colspan="15">暂无数据..</td>
        </tr>
        <?php else: if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr class="text-c">
            <td><?php echo (isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:''); ?></td>
            <td><?php echo (isset($vo['username']) && ($vo['username'] !== '')?$vo['username']:''); ?></td>
            <td><?php echo (isset($vo['nick_name']) && ($vo['nick_name'] !== '')?$vo['nick_name']:''); ?></td>
            <td>
                <?php if(!(empty($vo['status']) || ($vo['status'] instanceof \think\Collection && $vo['status']->isEmpty()))): switch($vo['status']): case "1": ?><span class="label label-success radius">正常</span><?php break; case "2": ?><span class="label label-info radius">禁用</span><?php break; default: ?>--
                <?php endswitch; endif; ?>
            </td>
            <td><?php echo (isset($vo['total_buy_order']) && ($vo['total_buy_order'] !== '')?$vo['total_buy_order']:'0'); ?></td>
            <td><?php echo (isset($vo['total_buy_money']) && ($vo['total_buy_money'] !== '')?$vo['total_buy_money']:'0'); ?></td>
            <td>
                <?php if(!(empty($vo['type']) || ($vo['type'] instanceof \think\Collection && $vo['type']->isEmpty()))): switch($vo['type']): case "1": ?><span class="label label-success radius">初级会员</span><?php break; case "-2": ?><span class="label label-info radius">高级会员</span><?php break; default: ?>--
                <?php endswitch; endif; ?>
            </td>
            <td><?php echo (isset($vo['phone']) && ($vo['phone'] !== '')?$vo['phone']:''); ?></td>
            <td><?php if(!(empty($vo['last_login_time']) || ($vo['last_login_time'] instanceof \think\Collection && $vo['last_login_time']->isEmpty()))): ?><?php echo date('Y-m-d H:i:s',$vo['last_login_time']); else: ?>未登录<?php endif; ?></td>
            <td><?php echo (isset($vo['province']) && ($vo['province'] !== '')?$vo['province']:'--'); ?></td>
            <td><?php echo (isset($vo['city']) && ($vo['city'] !== '')?$vo['city']:'--'); ?></td>
            <td><?php echo (isset($vo['area']) && ($vo['area'] !== '')?$vo['area']:'--'); ?></td>
            <td><?php echo (isset($vo['addr']) && ($vo['addr'] !== '')?$vo['addr']:'--'); ?></td>
            <td><?php echo (isset($vo['remark']) && ($vo['remark'] !== '')?$vo['remark']:'--'); ?></td>
            <td class="td-manage">
                <input class="btn btn-secondary radius open_form"  data-url="<?php echo url('update',['id'=>$vo['id'],'type'=>'edit']); ?>" type="button" value="编辑">
                <input class="btn btn-danger radius del_user" data-type="<?php echo (isset($vo['type']) && ($vo['type'] !== '')?$vo['type']:1); ?>" data-id="<?php echo (isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:0); ?>" type="button" value="删除">
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
<input type="hidden" id="del_user" value="<?php echo url('admin/user/del_user'); ?>">
<input type="hidden" id="forbid_user" value="<?php echo url('admin/user/forbid'); ?>">
<input type="hidden" id="unforbid_user" value="<?php echo url('admin/user/unforbid'); ?>">

</div>



<script>
    $(".del_user").click(function(){
        var url = $("#del_user").val();
        var id = $(this).data('id');
        layer.confirm("您确定要删除该用户?",{
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
        var url = $("#forbid_user").val();
        var id = $(this).data('id');
        $.common_ajax(url,{id:id},function(rt){
            layer.msg(rt.msg);
            if(rt.code == 1){
                location.reload();
            }
        })
    });

    $(".unforbid").click(function(){
        var url = $("#unforbid_user").val();
        var id = $(this).data('id');
        $.common_ajax(url,{id:id},function(rt){
            layer.msg(rt.msg);
            if(rt.code == 1){
                location.reload();
            }
        })
    });
</script>

</body>
</html>