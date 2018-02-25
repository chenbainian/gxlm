<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:28:"./tpl/api/ucenter\index.html";i:1519484428;s:25:"./tpl/api/base\base1.html";i:1519484428;s:25:"./tpl/api/base\base2.html";i:1519484428;s:25:"./tpl/api/base\base3.html";i:1519484428;s:25:"./tpl/api/base\base4.html";i:1519484428;s:25:"./tpl/api/base\base5.html";i:1519484428;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>个人资料</title>

		<link rel="stylesheet" type="text/css" href="/public/static/api/AmazeUI-2.4.2/assets/css/admin.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/AmazeUI-2.4.2/assets/css/amazeui.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/css/personal.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/css/infstyle.css" />
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

						<!--悬浮搜索框-->

					<div class="nav white">
    <div class="logo"><img src="/public/static/api/images/logo.png" /></div>
    <div class="logoBig">
        <li><img src="/public/static/api/images/logobig.png" /></li>
    </div>

    <div class="search-bar pr">
        <a name="index_none_header_sysc" href="#"></a>
        <form>
            <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="<?php echo (isset($goods_name) && ($goods_name !== '')?$goods_name:''); ?>" autocomplete="on">
            <input id="ai-topsearch" class="submit am-btn"  value="搜索" index="1" type="submit">
        </form>
    </div>
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

					<div class="user-info">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
						</div>
						<hr/>

						<!--头像 -->
						<div class="user-infoPic">

							<div class="filePic">
								<img class="am-circle am-img-thumbnail" src="/public/static/api/images/getAvatar.do.jpg" alt="" />
							</div>

							<p class="am-form-help">头像</p>

							<div class="info-m">
								<div><b>用户名：<i><?php echo (isset($user_info['username']) && ($user_info['username'] !== '')?$user_info['username']:''); ?></i></b></div>
								<div class="u-level">
									<span class="rank r2">
							             <s class="vip1"></s>
										<?php switch($user_info['type']): case "1": ?>初级会员<?php break; case "2": ?>高级会员<?php break; default: ?>初级会员
										<?php endswitch; ?>

						            </span>
								</div>

							</div>
						</div>

						<!--个人信息 -->
						<div class="info-main">
							<form class="am-form am-form-horizontal">

								<div class="am-form-group" id="user-name">
									<label for="user-name" class="am-form-label">姓名</label>
									<div class="am-form-content">
										<input type="text" id="user-name2" placeholder="姓名" value="<?php echo (isset($user_info['nick_name']) && ($user_info['nick_name'] !== '')?$user_info['nick_name']:''); ?>">
									</div>
								</div>


								<div class="am-form-group">
									<label for="user-phone" class="am-form-label">电话</label>
									<div class="am-form-content">
										<input id="user-phone" placeholder="电话" type="tel" value="<?php echo (isset($user_info['phone']) && ($user_info['phone'] !== '')?$user_info['phone']:''); ?>">

									</div>
								</div>

								<div class="am-form-group" >
									<label for="user-name" class="am-form-label">上次登录IP</label>
									<div class="am-form-content">
										<input type="text"  placeholder="最后登录IP" value="<?php echo (isset($user_info['last_login_ip']) && ($user_info['last_login_ip'] !== '')?$user_info['last_login_ip']:''); ?>">
									</div>
								</div>

								<div class="am-form-group">
									<label for="user-name" class="am-form-label">上次登录</label>
									<div class="am-form-content">
										<input type="text" placeholder="最后登录时间" value="<?php echo date('Y-m-d H:i:s',$user_info['last_login_time']); ?>">
									</div>
								</div>



								<div class="am-form-group">
									<label for="user-birth" class="am-form-label">地址</label>
									<div class="am-form-content birth">
										<div class="birth-select">
											<select>
												<option value="a"><?php echo (isset($user_info['province']) && ($user_info['province'] !== '')?$user_info['province']:''); ?></option>
											</select>
										</div>
										<div class="birth-select">
											<select>
												<option value="a"><?php echo (isset($user_info['city']) && ($user_info['city'] !== '')?$user_info['city']:''); ?></option>
											</select>
										</div>
										<div class="birth-select">
											<select>
												<option value="a"><?php echo (isset($user_info['area']) && ($user_info['area'] !== '')?$user_info['area']:''); ?></option>
											</select>
										</div>
										<div class="birth-select">
											<select>
												<option value="a"><?php echo (isset($user_info['addr']) && ($user_info['addr'] !== '')?$user_info['addr']:''); ?></option>
											</select>
										</div>

									</div>
								</div>



							</form>
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
            <a href="index.html">个人中心</a>
        </li>
        <li class="person">
            <a href="#" style="font-weight:bold">个人资料</a>
            <ul>
                <li> <a href="information.html">个人信息</a></li>
                <li> <a href="address.html">收货地址</a></li>
            </ul>
        </li>
        <li class="person" style="font-weight:bold">
            <a href="#">我的交易</a>
            <ul>
                <li  class="active"><a href="order.html">订单管理</a></li>
                <li> <a href="change.html">售后</a></li>
            </ul>
        </li>
    </ul>

</aside>
		</div>

	</body>

</html>