<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:32:"./tpl/api/shop_car\shop_car.html";i:1519656308;s:25:"./tpl/api/base\base1.html";i:1519484428;s:25:"./tpl/api/base\base2.html";i:1519484428;s:25:"./tpl/api/base\base4.html";i:1519484428;s:29:"./tpl/api/base\common_js.html";i:1519484428;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>购物车页面</title>

		<link rel="stylesheet" type="text/css" href="/public/static/api/AmazeUI-2.4.2/assets/css/amazeui.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/basic/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/css/cartstyle.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/css/optstyle.css" />
		<script type="text/javascript" src="/public/static/api/js/jquery.js"></script>


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

			<!--购物车 -->
			<div class="concent">
				<div id="cartTable">
					<div class="cart-table-th">
						<div class="wp">
							<div class="th th-chk">
								<div id="J_SelectAll1" class="select-all J_SelectAll">

								</div>
							</div>
							<div class="th th-item">
								<div class="td-inner">商品信息</div>
							</div>
							<div class="th th-price">
								<div class="td-inner">单价</div>
							</div>
							<div class="th th-amount">
								<div class="td-inner">数量</div>
							</div>
							<div class="th th-sum">
								<div class="td-inner">金额</div>
							</div>
							<div class="th th-op">
								<div class="td-inner">操作</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>


					<tr class="item-list">
						<?php if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<div class="bundle  bundle-last " data-car_id="<?php echo (isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:''); ?>">
							<div class="clear"></div>
							<div class="bundle-main">
								<ul class="item-content clearfix">

									<li class="td td-item">
										<div class="item-pic">
											<a href="#" target="_blank" data-title="<?php echo (isset($vo['goods_name']) && ($vo['goods_name'] !== '')?$vo['goods_name']:''); ?>" class="J_MakePoint" data-point="tbcart.8.12">
												<img src="<?php echo (isset($vo['img_src']) && ($vo['img_src'] !== '')?$vo['img_src']:''); ?>" style="width: 80px" class="itempic J_ItemImg"></a>
										</div>
										<div class="item-info">
											<div class="item-basic-info">
												<a href="#" target="_blank" title="<?php echo (isset($vo['goods_name']) && ($vo['goods_name'] !== '')?$vo['goods_name']:''); ?>" class="item-title J_MakePoint" data-point="tbcart.8.11"><?php echo (isset($vo['goods_name']) && ($vo['goods_name'] !== '')?$vo['goods_name']:''); ?></a>
											</div>
										</div>
									</li>
									<li class="td td-info">
										<div class="item-props item-props-can">
											<span class="sku-line">商品描述：</span>
											<span class="sku-line"><?php echo (isset($vo['desc']) && ($vo['desc'] !== '')?$vo['desc']:''); ?></span>
											<br/>
											<span class="sku-line">商品库存：</span>
											<span class="sku-line"><?php echo (isset($vo['stock_num']) && ($vo['stock_num'] !== '')?$vo['stock_num']:''); ?></span>
											<br/>
											<span class="sku-line">商品单位：</span>
											<span class="sku-line"><?php echo (isset($vo['unit']) && ($vo['unit'] !== '')?$vo['unit']:''); ?></span>
										</div>

									</li>
									<li class="td td-price">
										<div class="item-price price-promo-promo">
											<div class="price-content">
												<div class="price-line">
													<em class="price-original"><?php echo (isset($vo['show_price']) && ($vo['show_price'] !== '')?$vo['show_price']:'0.00'); ?></em>
												</div>
												<div class="price-line">
													<em class="J_Price price-now" tabindex="0"><?php echo (isset($vo['true_price']) && ($vo['true_price'] !== '')?$vo['true_price']:'0.00'); ?></em>
												</div>
											</div>
										</div>
									</li>
									<li class="td td-amount">
										<div class="amount-wrapper ">
											<div class="item-amount ">
												<div class="sl">
													<input class="min am-btn"  type="button" value="-" />
													<input class="text_box" name="" type="text" value="<?php echo (isset($vo['num']) && ($vo['num'] !== '')?$vo['num']:1); ?>" style="width:30px;" />
													<input class="add am-btn"  type="button" value="+" />
												</div>
											</div>
										</div>
									</li>
									<li class="td td-sum">
										<div class="td-inner">
											<em tabindex="0" class="J_ItemSum number">0</em>
										</div>
									</li>
									<li class="td td-op">
										<div class="td-inner">
											<a href="javascript:;" data-point-url="#" class="delete">
                  删除</a>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</tr>
				</div>
				<div class="clear"></div>

				<div class="float-bar-wrapper">

					<div class="float-bar-right">

						<div class="price-sum">
							<span class="txt">合计:</span>
							<strong class="price">¥<em class="J_Total">0.00</em></strong>
						</div>
						<?php if(!(empty($list) || ($list instanceof \think\Collection && $list->isEmpty()))): ?>
						<div class="btn-area">

							<a href="<?php echo url('api/order/pay'); ?>" id="J_Go" class="submit-btn submit-btn-disabled" aria-label="请注意如果没有选择宝贝，将无法结算">
								<span>结&nbsp;算</span></a>
						</div>
						<?php endif; ?>
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
	</body>
	<input type="hidden" id="update_car_num" value="<?php echo url('api/shop_car/update_goods_num'); ?>">
	<input type="hidden" id="init_all_price" value="<?php echo url('api/shop_car/init_price'); ?>">
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
		function init_all_price(){
			init_price();
			init_total_price();
		}

		init_all_price();

		function init_price(){
			$(".bundle").each(function(){
				var num = $(this).find('.text_box').val();
				var price = $(this).find('.J_Price').html();
				var total_price =pub.accMul(num,price);
				total_price = total_price.toFixed(2);
				$(this).find(".J_ItemSum").html(total_price);
			});
		}

		function init_total_price(){
		    var all_goods_price = 0;
			$(".J_ItemSum").each(function () {
                all_goods_price += parseFloat($(this).html());
            });
			all_goods_price = all_goods_price.toFixed(2);
            $(".J_Total").html(all_goods_price);
		}




		$(document).on("click",'.am-btn',function(){
			var that = $(this);
			var url = $("#update_car_num").val();
			var buy_num = $(this).siblings('.text_box').val();
			var car_id = $(this).parents('.bundle').data('car_id');

			var data = {
				num : buy_num,
				car_id : car_id
			};

			$.common_ajax(url,data,function(res){
				layer.msg(res.msg);
                if(buy_num <= 0){
                    that.parents('.bundle').remove();
                }else{
                    that.siblings('.text_box').val(res.ret_data.num);
                    that.parent('.bundle').find('.J_Price').html(res.ret_data.price);

                }
				init_all_price();
			});

		});

		$(document).on("change",'.text_box',function(){
			var that = $(this);
			var url = $("#update_car_num").val();
			var buy_num = $(".text_box").val();
			var car_id = $(this).parents('.bundle').data('car_id');

			var data = {
				num : buy_num,
				car_id : car_id
			};
			$.common_ajax(url,data,function(res){
				layer.msg(res.msg);
                if(buy_num <= 0){
                    that.parents('.bundle').remove();
                }else{
                    that.val(res.ret_data.num);
                    that.parents('.bundle').find('.J_Price').html(res.ret_data.price);
				}
				init_all_price();
			});
		});

		$(document).on("click",'.delete',function () {
            var that = $(this);
            var url = $("#update_car_num").val();
            var car_id = $(this).parents('.bundle').data('car_id');
            var buy_num = 0;
            var data = {
                num : buy_num,
                car_id : car_id
			};

            $.common_ajax(url,data,function(res){
                layer.msg(res.msg);
                if(res.code == 1){
                    that.parents('.bundle').remove();
				}
                init_all_price();
            });
        })
	</script>
</html>