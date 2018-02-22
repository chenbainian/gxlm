<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:27:"./tpl/api/goods\detail.html";i:1518338725;s:25:"./tpl/api/base\base1.html";i:1513416791;s:25:"./tpl/api/base\base2.html";i:1513422050;s:25:"./tpl/api/base\base3.html";i:1513417508;s:25:"./tpl/api/base\base4.html";i:1513417054;s:29:"./tpl/api/base\common_js.html";i:1488437847;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>商品页面</title>
		<link rel="stylesheet" type="text/css" href="/public/static/api/AmazeUI-2.4.2/assets/css/admin.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/AmazeUI-2.4.2/assets/css/amazeui.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/basic/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/css/optstyle.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/css/style.css" />
		<script type="text/javascript" src="/public/static/api/basic/js/jquery-1.7.min.js"></script>
		<script type="text/javascript" src="/public/static/api/basic/js/quick_links.js"></script>
		<script type="text/javascript" src="/public/static/api/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
		<script type="text/javascript" src="/public/static/api/js/jquery.imagezoom.min.js"></script>
		<script type="text/javascript" src="/public/static/api/js/jquery.flexslider.js"></script>
		<script type="text/javascript" src="/public/static/api/js/list.js"></script>

	</head>

	<body>


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
            <b class="line"></b>
			<div class="listMain">

				<!--分类-->
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
				<ol class="am-breadcrumb am-breadcrumb-slash">
					<li><a href="#"><?php echo (isset($big_cate_name) && ($big_cate_name !== '')?$big_cate_name:'首页'); ?></a></li>
					<li><a href="#"><?php echo (isset($small_cate_name) && ($small_cate_name !== '')?$small_cate_name:'分类'); ?></a></li>
					<li class="am-active"><?php echo (isset($goods_info['title']) && ($goods_info['title'] !== '')?$goods_info['title']:''); ?></li>
				</ol>
				<script type="text/javascript">
					$(function() {});
					$(window).load(function() {
						$('.flexslider').flexslider({
							animation: "slide",
							start: function(slider) {
								$('body').removeClass('loading');
							}
						});
					});
				</script>
				<div class="scoll">
					<section class="slider">
						<div class="flexslider">
							<ul class="slides">
								<li>
									<img src="{}" title="pic" />
								</li>

							</ul>
						</div>
					</section>
				</div>

				<!--放大镜-->

				<div class="item-inform">
					<div class="clearfixLeft" id="clearcontent">

						<div class="box">
							<script type="text/javascript">
								$(document).ready(function() {
									$(".jqzoom").imagezoom();
									$("#thumblist li a").click(function() {
										$(this).parents("li").addClass("tb-selected").siblings().removeClass("tb-selected");
										$(".jqzoom").attr('src', $(this).find("img").attr("mid"));
										$(".jqzoom").attr('rel', $(this).find("img").attr("big"));
									});
								});
							</script>

							<div class="tb-booth tb-pic tb-s310">
								<a href="/public/static/api/images/01.jpg"><img src="/public/static/api/images/01_mid.jpg" alt="细节展示放大镜特效" rel="/public/static/api/images/01.jpg" class="jqzoom" /></a>
							</div>
							<ul class="tb-thumb" id="thumblist">
								<li class="tb-selected">
									<div class="tb-pic tb-s40">
										<a href="#"><img src="<?php echo (isset($goods_info['img_src']) && ($goods_info['img_src'] !== '')?$goods_info['img_src']:''); ?>" mid="/public/static/api/images/01_mid.jpg" big="<?php echo (isset($goods_info['img_src']) && ($goods_info['img_src'] !== '')?$goods_info['img_src']:''); ?>"></a>
									</div>
								</li>
							</ul>
						</div>

						<div class="clear"></div>
					</div>

					<div class="clearfixRight">

						<!--规格属性-->
						<!--名称-->
						<div class="tb-detail-hd">
							<h1>【<?php echo (isset($goods_info['title']) && ($goods_info['title'] !== '')?$goods_info['title']:''); ?>】-<?php echo (isset($goods_info['desc']) && ($goods_info['desc'] !== '')?$goods_info['desc']:''); ?></h1>
						</div>
						<div class="tb-detail-list">
							<!--价格-->
							<div class="tb-detail-price">
								<li class="price iteminfo_price">
									<dt>促销价</dt>
									<dd><em>¥</em><b class="sys_item_price"><?php echo (isset($goods_info['true_price']) && ($goods_info['true_price'] !== '')?$goods_info['true_price']:'0.00'); ?></b>  </dd>
								</li>
								<li class="price iteminfo_mktprice">
									<dt>原价</dt>
									<dd><em>¥</em><b class="sys_item_mktprice"><?php echo (isset($goods_info['show_price']) && ($goods_info['show_price'] !== '')?$goods_info['show_price']:'0.00'); ?></b></dd>
								</li>
								<div class="clear"></div>
							</div>

							<div class="clear"></div>



							<!--各种规格-->
							<dl class="iteminfo_parameter sys_item_specpara">
								<dt class="theme-login"><div class="cart-title">可选规格<span class="am-icon-angle-right"></span></div></dt>
								<dd>
									<!--操作页面-->

									<div class="theme-popover-mask"></div>

									<div class="theme-popover">
										<div class="theme-span"></div>
										<div class="theme-poptit">
											<a href="javascript:;" title="关闭" class="close">×</a>
										</div>
										<div class="theme-popbod dform">
											<form class="theme-signin" name="loginform" action="" method="post">

												<div class="theme-signin-left">

													<div class="theme-options">
														<div class="cart-title">规格</div>
														<ul>
															<li class="sku-line selected"><?php echo (isset($goods_info['unit']) && ($goods_info['unit'] !== '')?$goods_info['unit']:'个'); ?><i></i></li>
														</ul>
													</div>
													<div class="theme-options">
														<div class="cart-title number">数量</div>
														<dd>
															<input id="min" class="am-btn am-btn-default" data-type="min" type="button" value="-" />
															<input id="text_box" type="text" value="1" style="width:30px;" />
															<input id="add" class="am-btn am-btn-default" data-type="add" type="button" value="+" />
															<span id="Stock" class="tb-hidden">库存：<span class="stock" id="left_num"><?php echo (isset($goods_info['num']) && ($goods_info['num'] !== '')?$goods_info['num']:'0'); ?></span>&nbsp&nbsp<?php echo (isset($goods_info['unit']) && ($goods_info['unit'] !== '')?$goods_info['unit']:'个'); ?></span>
														</dd>

													</div>
													<div class="clear"></div>

													<div class="btn-op">
														<div class="btn am-btn am-btn-warning">确认</div>
														<div class="btn close am-btn am-btn-warning">取消</div>
													</div>
												</div>


											</form>
										</div>
									</div>


							<div class="clear"></div>
							<!--活动	-->

							<div class="pay">
								<div class="pay-opt">
									<a href="home.html"><span class="am-icon-home am-icon-fw">首页</span></a>
									<a><span class="am-icon-heart am-icon-fw">收藏</span></a>

								</div>
								<li>
									<div class="clearfix tb-btn tb-btn-buy theme-login">
										<a id="LikBuy" title="点此按钮到下一步确认购买信息" href="#">立即购买</a>
									</div>
								</li>
								<li>
									<div class="clearfix tb-btn tb-btn-basket theme-login">
										<a id="LikBasket" title="加入购物车" href="javascript:;"><i></i>加入购物车</a>
									</div>
								</li>
							</div>
					</div>

					<div class="clear"></div>

				</div>

				<!--优惠套装-->

				<div class="clear"></div>


				<!-- introduce-->

				<div class="introduce">
					<div class="introduceMain">
						<div class="am-tabs" data-am-tabs>
							<ul class="am-avg-sm-3 am-tabs-nav am-nav am-nav-tabs">
								<li class="am-active">
									<a href="#">

										<span class="index-needs-dt-txt">宝贝详情</span></a>

								</li>




							</ul>

							<div class="am-tabs-bd">

								<div class="am-tab-panel am-fade am-in am-active">

									<div class="details">
										<div class="attr-list-hd after-market-hd">
											<h4>商品细节</h4>
										</div>
										<div class="twlistNews">
											<img src="/public/static/api/images/tw1.jpg" />
											<img src="/public/static/api/images/tw2.jpg" />
											<img src="/public/static/api/images/tw3.jpg" />
											<img src="/public/static/api/images/tw4.jpg" />
											<img src="/public/static/api/images/tw5.jpg" />
											<img src="/public/static/api/images/tw6.jpg" />
											<img src="/public/static/api/images/tw7.jpg" />
										</div>
									</div>
									<div class="clear"></div>

								</div>

							</div>

						</div>

						<div class="clear"></div>

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

				</div>
			</div>
	</body>

	<input type="hidden" id="add_shop_car_url" value="<?php echo url('api/shop_car/add_car'); ?>">
	<input type="hidden" id="goods_id" value="<?php echo (isset($goods_info['id']) && ($goods_info['id'] !== '')?$goods_info['id']:''); ?>">
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
	$(document).on("change",'#text_box',function(){
		var buy_num = parseInt($("#text_box").val());
		var left_num = parseInt($("#left_num").html());
		if(buy_num > left_num){
			$("#text_box").val(left_num);
		}
		if(buy_num < 0){
			$("#text_box").val(1);
		}
	});

	$(document).on("click",'.am-btn-default',function(){
		var buy_num = parseInt($("#text_box").val());
		var left_num = parseInt($("#left_num").html());

		if(buy_num >= left_num){
			$("#text_box").val(left_num);
		}
		if(buy_num <= 0){
			$("#text_box").val(1);
		}
	});

	$(document).on("click","#LikBasket",function(){
		var buy_num = parseInt($("#text_box").val());
		var goods_id = $("#goods_id").val();
		var url = $("#add_shop_car_url").val();
		var data = {
			goods_id:goods_id,
			num : buy_num
		};
		$.common_ajax(url,data,function(res){
			layer.msg(res.msg);
		})
	});


</script>

</html>