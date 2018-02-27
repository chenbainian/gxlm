<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:33:"./tpl/api/ucenter\order_list.html";i:1519746785;s:25:"./tpl/api/base\base1.html";i:1519484428;s:25:"./tpl/api/base\base3.html";i:1519484428;s:25:"./tpl/api/base\base4.html";i:1519484428;s:25:"./tpl/api/base\base5.html";i:1519734589;s:29:"./tpl/api/base\common_js.html";i:1519484428;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>订单管理</title>

		<link rel="stylesheet" type="text/css" href="/public/static/api/AmazeUI-2.4.2/assets/css/admin.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/AmazeUI-2.4.2/assets/css/amazeui.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/css/personal.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/css/orstyle.css" />
		<script type="text/javascript" src="/public/static/api/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="/public/static/api/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
		<script type="text/javascript" src="/public/static/api/js/common.js"></script>


	</head>

	<body>
		<!--头 -->
		<header>
			<article>
				<div class="mt-logo">
					<!--顶部导航条 -->
					<div class="am-container header">
    <ul class="message-r">
        <div class="topMessage home">
            <div class="menu-hd"><a href="<?php echo url('index/index'); ?>" target="_top" class="h">商城首页</a></div>
        </div>
        <div class="topMessage my-shangcheng">
            <div class="menu-hd MyShangcheng"><a href="<?php echo url('ucenter/index'); ?>" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
        </div>
        <div class="topMessage mini-cart">
            <div class="menu-hd"><a id="mc-menu-hd" href="<?php echo url('shop_car/car_list'); ?>" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h"></strong></a></div>
        </div>
    </ul>
</div>


						<div class="clear"></div>
					</div>
				</div>
			</article>
		</header>
            <div class="nav-table">
				
<div class="long-title"><span class="all-goods">全部分类</span></div>
<div class="nav-cont">
    <ul>
        <li class="index"><a href="<?php echo url('index/index'); ?>">首页</a></li>
        <li class="qc"><a href="<?php echo url('goods/search'); ?>">分类查找</a></li>
        <li class="qc"><a href="<?php echo url('shop_car/car_list'); ?>">购物车</a></li>
        <li class="qc"><a href="<?php echo url('ucenter/order_list'); ?>">我的订单</a></li>
    </ul>
    <div class="nav-extra">
        <a href="<?php echo url('ucenter/index'); ?>"><i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>个人中心
            <i class="am-icon-angle-right" style="padding-left: 10px;"></i></a>
    </div>
</div>

			</div>
			<b class="line"></b>
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-order">

						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">订单管理</strong> / <small>Order</small></div>
						</div>
						<hr/>

						<div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>

							<ul class="am-avg-sm-5 am-tabs-nav am-nav am-nav-tabs">
								<li class="am-active"><a href="#tab1" class="order_tabs" data-status="">所有订单</a></li>
								<li ><a href="#tab2" class="order_tabs" data-status="1">待接单</a></li>
								<li ><a href="#tab3" class="order_tabs" data-status="2">待收货</a></li>
								<li ><a href="#tab4" class="order_tabs" data-status="3">已收货</a></li>
								<li ><a href="#tab5" class="order_tabs" data-status="4">异常订单</a></li>
							</ul>

							<div class="am-tabs-bd">
								<div class="am-tab-panel am-fade am-in am-active" id="tab1">

								</div>
								<div class="am-tab-panel am-fade" id="tab2">

								</div>
								<div class="am-tab-panel am-fade" id="tab3">

								</div>
								<div class="am-tab-panel am-fade" id="tab4">

								</div>

								<div class="am-tab-panel am-fade" id="tab5" >

								</div>
							</div>

						</div>
					</div>
				</div>

				<!--底部-->
				<div class="footer " style="margin-top: 5%">
    <div class="footer-bd " style="margin-left: 40%">
        <p>
            <a href="# ">关于高校联盟</a>
            <a href="# ">联系我们</a>
            <em>© 2017-2025 gxlm.site 版权所有 </em>
        </p>
    </div>
</div>
			</div>
			<aside class="menu">
    <ul>
        <li class="person">
            <a href="<?php echo url('api/ucenter/index'); ?>">个人中心</a>
        </li>
        <li class="person">
            <a href="<?php echo url('api/ucenter/index'); ?>" style="font-weight:bold">个人资料</a>
        </li>
        <li class="person" style="font-weight:bold">
            <a href="<?php echo url('api/ucenter/order_list'); ?>">我的交易</a>
        </li>
    </ul>

</aside>
		</div>
	</body>
	<input type="hidden" id="ajax_order_list" value="<?php echo url('api/order/ajax_order_list'); ?>">
</html>
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


<script>
	$(document).on("click",'.order_tabs',function () {
		var status = $(this).data("status");
		var tab = $(this).attr('href');
		get_ajax_list(status,1,tab);
    });

	function get_ajax_list(status,page,tab) {
        var url = $("#ajax_order_list").val();
	    var param = {
	      	status:status,
			page:page
		};
        $.common_ajax(url,param,function (res) {
            if(res.code == 1){
                $(tab).html('');
				$(tab).html(res.html);
            }else{
                layer.msg(res.msg);
			}
        })
    }

    $(document).on("click",".am-pagination a",function (event) {
        event.preventDefault();
        var active = $(".order_tabs,.am-active");
        var href = $(this).attr('href');
        var status = active.find('a').data("status");
        var tab = active.find('a').attr("href");
		var page_index = href.indexOf("page=");
		var page = href.substr(page_index+5);
        get_ajax_list(status,page,tab);
		$(this).parent().addClass('am-active');
		$(this).parent().siblings().removeClass('am-active');
    });

	$(document).on("click",".anniu",function () {
		layer.msg("已经通知管理员,如果管理不在电脑旁,请电话联系");
    });


    get_ajax_list('',1,'#tab1');
</script>