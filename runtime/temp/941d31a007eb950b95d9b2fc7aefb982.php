<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:26:"./tpl/api/index/index.html";i:1513316564;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>首页</title>
		<link rel="stylesheet" type="text/css" href="/public/static/api/AmazeUI-2.4.2/assets/css/amazeui.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/AmazeUI-2.4.2/assets/css/admin.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/basic/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/css/hmstyle.css" />
		<script type="text/javascript" src="/public/static/api/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="/public/static/api/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>

	</head>

	<body>
		<div class="hmtop">
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
							<input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
							<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
						</form>
					</div>
				</div>

				<div class="clear"></div>
			</div>


			<div class="banner">
                      <!--轮播 -->
						<div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
							<ul class="am-slides">
								<li class="banner1"><img src="/public/static/api/images/ad1.jpg" /></li>
								<li class="banner2"><img src="/public/static/api/images/ad2.jpg" /></li>
								<li class="banner3"><img src="/public/static/api/images/ad3.jpg" /></li>
								<li class="banner4"><img src="/public/static/api/images/ad4.jpg" /></li>
							</ul>
						</div>
						<div class="clear"></div>
			</div>

			<div class="shopNav">
				<div class="slideall">

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

						<!--侧边导航 -->
						<div id="nav" class="navfull">
							<div class="area clearfix">
								<div class="category-content" id="guide_2">

									<div class="category">
										<ul class="category-list" id="js_climit_li">
											<?php if(is_array($big_cates) || $big_cates instanceof \think\Collection): $i = 0; $__LIST__ = $big_cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
											<li class="appliance js_toggle relative first">
												<div class="category-info">
													<h3 class="category-name b-category-name"><i><img src="/public/static/api/images/cake.png"></i><a class="ml-22" title="<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>"><?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?></a></h3>
													<em>&gt;</em></div>
												<div class="menu-item menu-in top">
													<div class="area-in">
														<div class="area-bg">
															<div class="menu-srot">
																<div class="sort-side">
																	<dl class="dl-sort">
																		<?php if(is_array($small_cates) || $small_cates instanceof \think\Collection): $i = 0; $__LIST__ = $small_cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;if($vo['id'] == $vo2['parent_id']): ?>
																			<dt><span title="<?php echo (isset($vo2['name']) && ($vo2['name'] !== '')?$vo2['name']:''); ?>"><?php echo (isset($vo2['name']) && ($vo2['name'] !== '')?$vo2['name']:''); ?></span></dt>
																		<?php endif; endforeach; endif; else: echo "" ;endif; if(is_array($goods) || $goods instanceof \think\Collection): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo3): $mod = ($i % 2 );++$i;if($vo3['big_cate_id'] == $vo['id']): ?>
																		<dd><a title="<?php echo (isset($vo3['title']) && ($vo3['title'] !== '')?$vo3['title']:''); ?>" href="#"><span><?php echo (isset($vo3['title']) && ($vo3['title'] !== '')?$vo3['title']:''); ?></span></a></dd>
																		<?php endif; endforeach; endif; else: echo "" ;endif; ?>
																	</dl>
																</div>

															</div>
														</div>
													</div>
												</div>
											<b class="arrow"></b>
											</li>
											<?php endforeach; endif; else: echo "" ;endif; $__FOR_START_863383187__=0;$__FOR_END_863383187__=10-count($big_cates);for($i=$__FOR_START_863383187__;$i < $__FOR_END_863383187__;$i+=1){ ?>
												<li class="appliance js_toggle relative">

												</li>
											<?php } ?>
										</ul>
									</div>
								</div>

							</div>
						</div>
						<!--轮播 -->
						<script type="text/javascript">
							(function() {
								$('.am-slider').flexslider();
							});
							$(document).ready(function() {
								$("li").hover(function() {
									$(".category-content .category-list li.first .menu-in").css("display", "none");
									$(".category-content .category-list li.first").removeClass("hover");
									$(this).addClass("hover");
									$(this).children("div.menu-in").css("display", "block")
								}, function() {
									$(this).removeClass("hover")
									$(this).children("div.menu-in").css("display", "none")
								});
							})
						</script>


					<!--小导航 -->

					<!--走马灯 -->

					<div class="clear"></div>
				</div>
				<script type="text/javascript">
					if ($(window).width() < 640) {
						function autoScroll(obj) {
							$(obj).find("ul").animate({
								marginTop: "-39px"
							}, 500, function() {
								$(this).css({
									marginTop: "0px"
								}).find("li:first").appendTo(this);
							})
						}
						$(function() {
							setInterval('autoScroll(".demo")', 3000);
						})
					}
				</script>
			</div>
			<div class="shopMainbg">
				<div class="shopMain" id="shopmain">

					<!--今日推荐 -->


					<div class="clear "></div>

				<?php if(is_array($big_cates) || $big_cates instanceof \think\Collection): $i = 0; $__LIST__ = $big_cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<div class="big_cate">
					<div class="am-container ">
						<div class="shopTitle ">
							<h4><?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:'其他'); ?></h4>
							<div class="today-brands ">
								<?php if(is_array($small_cates) || $small_cates instanceof \think\Collection): $i = 0; $__LIST__ = $small_cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;if($vo['id'] == $vo2['parent_id']): ?>
										<a href="#"><?php echo (isset($vo2['name']) && ($vo2['name'] !== '')?$vo2['name']:''); ?></a>
									<?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</div>
							<span class="more ">
                    <a class="more-link " href="# ">更多美味</a>
                        </span>
						</div>
					</div>
					<div class="am-g am-g-fixed flood method3 ">
						<ul class="am-thumbnails ">
							<?php if(is_array($goods) || $goods instanceof \think\Collection): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo3): $mod = ($i % 2 );++$i;if($vo3['big_cate_id'] == $vo['id']): ?>
									<li>
										<div class="list ">
											<a href="# ">
												<img src="<?php echo (isset($vo3['img_src']) && ($vo3['img_src'] !== '')?$vo3['img_src']:''); ?>" />
												<div class="pro-title "><?php echo (isset($vo3['title']) && ($vo3['title'] !== '')?$vo3['title']:''); ?></div>
												<span class="e-price "><?php echo (isset($vo3['true_price']) && ($vo3['true_price'] !== '')?$vo3['true_price']:''); ?></span>
											</a>
										</div>
									</li>
								<?php endif; endforeach; endif; else: echo "" ;endif; ?>
						</ul>

					</div>

				</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>




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
		</div>
		<!--引导 -->

		<div class="navCir">
			<li class="active"><a href="home3.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>
			<li><a href="/public/static/api/person/index.html"><i class="am-icon-user"></i>我的</a></li>
		</div>
		<!--菜单 -->


		<script type="text/javascript" src="/public/static/api/basic/js/jquery.min.js"></script>
		<script type="text/javascript" src="/public/static/api/basic/js/quick_links.js"></script>
	</body>

</html>