<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:27:"./tpl/api/ucenter\addr.html";i:1519734373;s:25:"./tpl/api/base\base1.html";i:1519484428;s:25:"./tpl/api/base\base3.html";i:1519484428;s:25:"./tpl/api/base\base4.html";i:1519484428;s:25:"./tpl/api/base\base5.html";i:1519734589;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>地址管理</title>
		<link rel="stylesheet" type="text/css" href="/public/static/api/AmazeUI-2.4.2/assets/css/admin.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/AmazeUI-2.4.2/assets/css/amazeui.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/css/personal.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/css/addstyle.css" />
		<script type="text/javascript" src="/public/static/api/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="/public/static/api/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
		

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

					<div class="user-address">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small></div>
						</div>
						<hr/>
						<ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">

							<li class="user-addresslist defaultAddr">
								<span class="new-option-r"><i class="am-icon-check-circle"></i>默认地址</span>
								<p class="new-tit new-p-re">
									<span class="new-txt"><?php echo (isset($user_info['nick_name']) && ($user_info['nick_name'] !== '')?$user_info['nick_name']:''); ?></span>
									<span class="new-txt-rd2"><?php echo (isset($user_info['phone']) && ($user_info['phone'] !== '')?$user_info['phone']:''); ?></span>
								</p>
								<div class="new-mu_l2a new-p-re">
									<p class="new-mu_l2cw">
										<span class="title">地址：</span>
										<span class="province"><?php echo (isset($user_info['province']) && ($user_info['province'] !== '')?$user_info['province']:''); ?></span>
										<span class="city"><?php echo (isset($user_info['city']) && ($user_info['city'] !== '')?$user_info['city']:''); ?></span>
										<span class="dist"><?php echo (isset($user_info['area']) && ($user_info['area'] !== '')?$user_info['area']:''); ?></span>
										<span class="street"><?php echo (isset($user_info['addr']) && ($user_info['addr'] !== '')?$user_info['addr']:''); ?></span></p>
								</div>
								<div class="new-addr-btn">
									<a href="#"><i class="am-icon-edit"></i>编辑</a>
									<span class="new-addr-bar">|</span>
									<a href="javascript:void(0);" onclick="delClick(this);"><i class="am-icon-trash"></i>删除</a>
								</div>
							</li>


						</ul>
						<div class="clear"></div>


					</div>


					<div class="clear"></div>

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

</html>