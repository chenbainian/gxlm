<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:24:"./tpl/api/order\pay.html";i:1519822991;s:25:"./tpl/api/base\base1.html";i:1519484428;s:25:"./tpl/api/base\base2.html";i:1519484428;s:25:"./tpl/api/base\base4.html";i:1519484428;s:29:"./tpl/api/base\common_js.html";i:1519484428;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0 ,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<title>结算页面</title>
	<link rel="stylesheet" type="text/css" href="/public/static/api/AmazeUI-2.4.2/assets/css/amazeui.css" />
	<link rel="stylesheet" type="text/css" href="/public/static/api/basic/css/demo.css" />
	<link rel="stylesheet" type="text/css" href="/public/static/api/css/cartstyle.css" />
	<link rel="stylesheet" type="text/css" href="/public/static/api/css/jsstyle.css" />
	<script type="text/javascript" src="/public/static/api/js/address.js"></script>


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
<div class="concent">
	<!--地址 -->
	<?php if(!(empty($list) || ($list instanceof \think\Collection && $list->isEmpty()))): ?>
	<div class="paycont">
		<!--支付方式-->
		<div class="clear"></div>

		<!--订单 -->
		<div class="concent">
			<div id="payTable">
				<h3>确认订单信息</h3>
				<div class="cart-table-th">
					<div class="wp">

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
						<div class="th th-oplist">
							<div class="td-inner">配送方式</div>
						</div>

					</div>
				</div>
				<div class="clear"></div>

				<tr class="item-list">
					<?php if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<div class="bundle  bundle-last">

						<div class="bundle-main">
							<ul class="item-content clearfix">
								<div class="pay-phone">
									<li class="td td-item">
										<div class="item-pic">
											<a href="#" class="J_MakePoint">
												<img src="<?php echo (isset($vo['img_src']) && ($vo['img_src'] !== '')?$vo['img_src']:''); ?>" style="width: 85px" class="itempic J_ItemImg"></a>
										</div>
										<div class="item-info">
											<div class="item-basic-info">
												<a href="#" class="item-title J_MakePoint" data-point="tbcart.8.11"><?php echo (isset($vo['goods_name']) && ($vo['goods_name'] !== '')?$vo['goods_name']:''); ?></a>
											</div>
										</div>
									</li>
									<li class="td td-info">
										<div class="item-props">
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
												<em class="J_Price price-now"><?php echo (isset($vo['true_price']) && ($vo['true_price'] !== '')?$vo['true_price']:'0.00'); ?></em>
											</div>
										</div>
									</li>
								</div>
								<li class="td td-amount">
									<div class="amount-wrapper ">
										<div class="item-amount ">
											<span class="phone-title">购买数量</span>
											<div class="sl">
												<input class="text_box" disabled type="text" value="3" style="width:30px;" />
											</div>
										</div>
									</div>
								</li>
								<li class="td td-sum">
									<div class="td-inner">
										<em tabindex="0" class="J_ItemSum number">0.00</em>
									</div>
								</li>
								<li class="td td-oplist">
									<div class="td-inner">
										<span class="phone-title">配送方式</span>
										<div class="pay-logis">
											专车配送<b class="sys_item_freprice">0</b>元
										</div>
									</div>
								</li>

							</ul>
							<div class="clear"></div>

						</div>
				</tr>
				<?php endforeach; endif; else: echo "" ;endif; ?>
				<div class="clear"></div>
			</div>

		</div>
		<div class="clear"></div>
		<div class="pay-total">
			<!--留言-->
			<div class="order-extra">
				<div class="order-user-info">
					<div id="holyshit257" class="memo">
						<label>买家留言：</label>
						<input type="text" title="选填,对本次交易的说明" placeholder="选填,建议填写和卖家达成一致的说明" class="memo-input J_MakePoint c2c-text-default memo-close">
						<div class="msg hidden J-msg">
							<p class="error">最多输入255个字符</p>
						</div>
					</div>
				</div>

			</div>
			<!--优惠券 -->
			<div class="buy-agio">
				<li class="td td-coupon">

					<span class="coupon-title">优惠券</span>
					<select data-am-selected>
						<option value="a">
							<div class="c-limit">
								暂无可用优惠券
							</div>
						</option>
					</select>
				</li>

			</div>
			<div class="clear"></div>
		</div>
		<!--含运费小计 -->
		<div class="buy-point-discharge ">
			<p class="price g_price ">
				合计（含运费） <span>¥</span><em class="pay-sum">0.00</em>
			</p>
		</div>

		<!--信息 -->
		<div class="order-go clearfix">
			<div class="pay-confirm clearfix">
				<div class="box">
					<div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
						<span class="price g_price ">
                                    <span>¥</span> <em class="style-large-bold-red " id="J_ActualFee">0.00</em>
											</span>
					</div>

					<div id="holyshit268" class="pay-address">

						<p class="buy-footer-address">
							<span class="buy-line-title buy-line-title-type">配送至：</span>
							<span class="buy--address-detail">
							<span class="province"><?php echo (isset($user_info['province']) && ($user_info['province'] !== '')?$user_info['province']:''); ?></span>省
							<span class="city"><?php echo (isset($user_info['city']) && ($user_info['city'] !== '')?$user_info['city']:''); ?></span>市
							<span class="dist"><?php echo (isset($user_info['area']) && ($user_info['area'] !== '')?$user_info['area']:''); ?></span>
							<span class="street"><?php echo (isset($user_info['addr']) && ($user_info['addr'] !== '')?$user_info['addr']:''); ?></span>
							</span>
							</span>
						</p>
						<p class="buy-footer-address">
							<span class="buy-line-title">收货人：</span>
							<span class="buy-address-detail">
                                         		<span class="buy-user"><?php echo (isset($user_info['nick_name']) && ($user_info['nick_name'] !== '')?$user_info['nick_name']:''); ?> </span>
												<span class="buy-phone"><?php echo (isset($user_info['phone']) && ($user_info['phone'] !== '')?$user_info['phone']:''); ?></span>
												</span>
						</p>
					</div>
				</div>

				<div id="holyshit269" class="submitOrder">
					<?php if(!(empty($list) || ($list instanceof \think\Collection && $list->isEmpty()))): ?>
					<div class="go-btn-wrap">
						<a id="J_Go" href="javascript:void(0);" class="btn-go" tabindex="0" title="点击此按钮，提交订单">提交订单</a>
					</div>
					<?php endif; ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="clear"></div>
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

<div class="clear"></div>
</body>
<input type="hidden" id="submit_url" value="<?php echo url('api/order/submit'); ?>">
<input type="hidden" id="pay_success" value="<?php echo url('api/order/pay_success'); ?>">
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
$(document).on("click",'#J_Go',function () {
	var url = $("#submit_url").val();
	var success_url = $("#pay_success").val();
	$.common_ajax(url,{},function (res) {
	    if(res.code == 1){
            location.href = success_url+'?order_id='+res.ret_data.order_id;
		}else{
	        layer.msg(res.msg);
	        setInterval(function () {
				location.reload();
            },1500);
		}

    })
});

function init_all_price(){
    init_price();
    init_total_price();
}

init_all_price();

function init_price(){
    $(".bundle").each(function(){
        var num = $(this).find('.text_box').val();
        var price = $(this).find('.price-now').html();
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
    $(".pay-sum").html(all_goods_price);
    $("#J_ActualFee").html(all_goods_price);
}

</script>

</html>