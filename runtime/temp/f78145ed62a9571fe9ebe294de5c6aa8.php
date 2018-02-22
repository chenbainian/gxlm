<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:28:"./tpl/admin/index\index.html";i:1513236618;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="/favicon.ico" >
    <link rel="Shortcut Icon" href="/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="__plugin__/html5.min.js"></script>
    <script type="text/javascript" src="__plugin__/respond.min.js"></script>
    <script type="text/javascript" src="__plugin__/PIE_IE678.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="__hui__/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="__hui_admin__/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="__plugin__/Hui-iconfont/1.0.7/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="__plugin__/icheck/icheck.css" />
    <link rel="stylesheet" type="text/css" href="__hui_admin__/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="__hui_admin__/css/style.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title><?php echo config('WEB_BK_SITE_NAME'); ?><?php echo __admin_version__; ?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
</head>
<body>
<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="<?php echo url('index/index'); ?>"><?php echo config('WEB_BK_SITE_NAME'); ?></a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="<?php echo url('index/index'); ?>"></a> <span class="logo navbar-slogan f-l mr-10 hidden-xs"><?php echo __admin_version__; ?></span> <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>

            <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                <ul class="cl">
                    <li><?php echo get_admin_role(); ?></li>
                    <li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A"><?php echo get_admin_name(); ?> <i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:" class="admin_change_password">修改密码</a></li>
                            <li><a href="javascript:" class="admin_quit">退出</a></li>
                        </ul>
                    </li>
                    <li id="Hui-msg" style="display: none"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
                    <li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
                            <li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
                            <li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
                            <li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
                            <li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
                            <li><a href="javascript:;" data-val="orange" title="绿色">橙色</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<aside class="Hui-aside">
    <input runat="server" id="divScrollValue" type="hidden" value="" />
    <!--菜单开始-->
    <div class="menu_dropdown bk_2">

        <dl id="menu-article">
            <dt>
                <i class="Hui-iconfont">&#xe616;</i> 管理员
                <i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>

                    <li>
                        <a _href="<?php echo url('admin/account/admin_list'); ?>" data-title="管理员管理">管理员管理</a>
                    </li>

                </ul>
            </dd>
        </dl>

        <dl id="menu-broad">
            <dt>
                <i class="Hui-iconfont">&#xe616;</i> 轮播图管理
                <i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li>
                        <a _href="<?php echo url('admin/broad/broad_list'); ?>" data-title="轮播图管理">轮播图管理</a>
                    </li>
                </ul>
            </dd>
        </dl>

        <dl id="menu-user">
            <dt>
                <i class="Hui-iconfont">&#xe616;</i> 用户管理
                <i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li>
                        <a _href="<?php echo url('admin/user/user_list'); ?>" data-title="用户列表">用户列表</a>
                    </li>
                </ul>
            </dd>
        </dl>

        <dl id="menu-cate">
            <dt>
                <i class="Hui-iconfont">&#xe616;</i> 分类管理
                <i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li>
                        <a _href="<?php echo url('admin/cate/cate_list'); ?>" data-title="分类管理">分类管理</a>
                    </li>
                </ul>
            </dd>
        </dl>

        <dl id="menu-goods">
            <dt>
                <i class="Hui-iconfont">&#xe616;</i> 商品管理
                <i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li>
                        <a _href="<?php echo url('admin/goods/goods_list'); ?>" data-title="商品管理">商品管理</a>
                    </li>
                </ul>
            </dd>
        </dl>

        <dl id="menu-order">
            <dt>
                <i class="Hui-iconfont">&#xe616;</i> 订单管理
                <i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li>
                        <a _href="<?php echo url('admin/order/order_list'); ?>" data-title="订单管理">订单管理</a>
                    </li>
                </ul>
            </dd>
        </dl>



    </div>
    <!--菜单结束-->
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
    <div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
        <div class="Hui-tabNav-wp">
            <ul id="min_title_list" class="acrossTab cl">
                <li class="active"><span title="我的桌面" data-href="<?php echo Url('desktop'); ?>">我的桌面</span><em></em></li>
            </ul>
        </div>
        <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
    </div>

    <div id="iframe_box" class="Hui-article">
        <div class="show_iframe">
            <div style="display:none" class="loading"></div>
            <iframe scrolling="yes" frameborder="0" src="<?php echo Url('index/desktop'); ?>"></iframe>
        </div>
    </div>
</section>
<script type="text/javascript" src="__plugin__/jquery/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="__plugin__/layer/layer.js"></script>
<script type="text/javascript" src="__hui__/js/H-ui.js"></script>
<script type="text/javascript" src="__hui_admin__/js/H-ui.admin.js"></script>

<!--通用-->
<script type="text/javascript" src="__static__/public/js/common.js"></script>
<script type="text/javascript" src="__static__/admin/js/public.js"></script>

<script type="text/javascript">

    $(".admin_change_password").click(function(){
        layer.prompt({
            title: '请输入新密码',
            formType: 1 //prompt风格，支持0-2
        }, function(password){
           var url = $("#change_password").val();
           var param = {password:password};
           common.ajax_post(url,param,true,function (rt) {
               common.post_tips(rt);
               layer.closeAll();
           });
        });
    });

    $(".admin_quit").click(function(){
        var url = $("#admin_quit").val();
        $.common_ajax(url,{},function(rt){
            layer.msg(rt.msg);
            if(rt.code == 1){
                setInterval(function(){
                    window.location.href = $("#root_url").val();
                },2000);
            }
        })
    })

</script>
<input type="hidden" id="admin_quit" value='<?php echo url("admin/account/quit"); ?>'/><!--用户退出-->
<input type="hidden" id="change_password" value='<?php echo url("admin/account/change_password"); ?>'/><!--用户退出-->
<input type="hidden" id="root_url" value='<?php echo url("admin/account/index"); ?>'/><!--用户退出-->
</body>
</html>