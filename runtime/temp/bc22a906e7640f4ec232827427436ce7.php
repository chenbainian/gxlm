<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:27:"./tpl/api/goods\search.html";i:1513594062;s:25:"./tpl/api/base\base1.html";i:1513416791;s:25:"./tpl/api/base\base2.html";i:1513422050;s:25:"./tpl/api/base\base3.html";i:1513417508;s:25:"./tpl/api/base\base4.html";i:1513417054;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>搜索页面</title>

		<link rel="stylesheet" type="text/css" href="/public/static/api/AmazeUI-2.4.2/assets/css/amazeui.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/AmazeUI-2.4.2/assets/css/admin.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/basic/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/css/seastyle.css" />
		<script type="text/javascript" src="/public/static/api/basic/js/jquery-1.7.min.js"></script>
		<script type="text/javascript" src="/public/static/api/js/script.js"></script>
		<script type="text/javascript" src="/public/static/api/basic/js/quick_links.js"></script>
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
           <div class="search">
			<div class="search-list">
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
			
				
					<div class="am-g am-g-fixed">
						<div class="am-u-sm-12 am-u-md-12">
	                  	<div class="theme-popover">														

							<ul class="select">
								<?php if(!(empty($goods_name) || ($goods_name instanceof \think\Collection && $goods_name->isEmpty()))): ?>
								<p class="title font-normal">
									<span class="fl"><?php echo (isset($goods_name) && ($goods_name !== '')?$goods_name:''); ?></span>
									<span class="total fl">搜索到<strong class="num">0</strong>件相关商品</span>
								</p>
								<?php endif; ?>
								<div class="clear"></div>
								<li class="select-result">
									<dl>
										<dt>已选</dt>
										<dd class="select-no"></dd>
										<p class="eliminateCriteria">清除</p>
									</dl>
								</li>
								<div class="clear"></div>
								<li class="select-list">
									<dl id="select1">
										<dt class="am-badge am-round">分类</dt>
									
										 <div class="dd-conent">
											<dd class="select-all selected"><a href="#">全部</a></dd>
											 <?php if(is_array($big_cate_list) || $big_cate_list instanceof \think\Collection): $i = 0; $__LIST__ = $big_cate_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
												<dd><a href="#" class="big_cate"><?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?></a></dd>
											 <?php endforeach; endif; else: echo "" ;endif; ?>
										 </div>
						
									</dl>
								</li>
								<li class="select-list">
									<dl id="select2">
										<dt class="am-badge am-round">子分类</dt>
										<div class="dd-conent">
											<dd class="select-all selected"><a href="#">全部</a></dd>
											<?php if(is_array($small_cate_list) || $small_cate_list instanceof \think\Collection): $i = 0; $__LIST__ = $small_cate_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
											<dd><a href="#" class="small_cate"><?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?></a></dd>
											<?php endforeach; endif; else: echo "" ;endif; ?>
										</div>
									</dl>
								</li>
							</ul>
							<div class="clear"></div>
                        </div>
							<div class="search-content" style="width: 100%">
								<div class="sort">
									<li class="first"><a title="综合">综合排序</a></li>
									<li><a title="销量">销量排序</a></li>
									<li><a title="价格">价格优先</a></li>
									<li class="big"><a title="评价" href="#">评价为主</a></li>
								</div>
								<div class="clear"></div>
								<?php if(empty($goods_list) || ($goods_list instanceof \think\Collection && $goods_list->isEmpty())): ?>
								<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes" style="text-align:center;">
									很抱歉，没有找到您搜索的商品
								</ul>
								<?php else: ?>
								<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
									<?php if(is_array($goods_list) || $goods_list instanceof \think\Collection): $i = 0; $__LIST__ = $goods_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
									<li>
										<div class="i-pic limit">
											<img src="<?php echo (isset($vo['img_src']) && ($vo['img_src'] !== '')?$vo['img_src']:''); ?>" />
											<p class="title fl">【<?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?>】<?php echo (isset($vo['desc']) && ($vo['desc'] !== '')?$vo['desc']:''); ?></p>
											<p class="price fl">
												<b>¥</b>
												<strong><?php echo (isset($vo['true_price']) && ($vo['true_price'] !== '')?$vo['true_price']:'0.00'); ?></strong>
											</p>
											<p class="number fl">
												销量<span><?php echo (isset($vo['show_sales_num']) && ($vo['show_sales_num'] !== '')?$vo['show_sales_num']:'0'); ?></span>
											</p>
										</div>
									</li>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>
								<?php endif; ?>
							</div>
							<div class="clear"></div>
							<!--分页 -->
							<ul class="am-pagination am-pagination-right">
								<li class="am-disabled"><a href="#">&laquo;</a></li>
								<li class="am-active"><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#">5</a></li>
								<li><a href="#">&raquo;</a></li>
							</ul>

						</div>
					</div>
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

		

<div class="theme-popover-mask"></div>

	</body>

</html>