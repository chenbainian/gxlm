<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:32:"./tpl/api/order\pay_success.html";i:1519823058;s:25:"./tpl/api/base\base1.html";i:1519484428;s:25:"./tpl/api/base\base2.html";i:1519484428;s:25:"./tpl/api/base\base4.html";i:1519484428;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>付款成功页面</title>
<link rel="stylesheet" type="text/css" href="/public/static/api/AmazeUI-2.4.2/assets/css/amazeui.css" />
<link rel="stylesheet" type="text/css" href="/public/static/api/AmazeUI-2.4.2/assets/css/admin.css" />
<link rel="stylesheet" type="text/css" href="/public/static/api/basic/css/demo.css" />
<link rel="stylesheet" type="text/css" href="/public/static/api/css/sustyle.css" />
<script type="text/javascript" src="/public/static/api/basic/js/jquery-1.7.min.js"></script>
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



<div class="take-delivery">
 <div class="status">
   <h2>您已成功下单。请等待管理员接单或联系管理员</h2>
   <div class="successInfo">
     <ul>
       <li>订单金额<em><?php echo (isset($order_info['true_price']) && ($order_info['true_price'] !== '')?$order_info['true_price']:0.00); ?></em></li>
       <div class="user-info">
         <p>收货人：<?php echo (isset($user_info['nick_name']) && ($user_info['nick_name'] !== '')?$user_info['nick_name']:''); ?></p>
         <p>联系电话：<?php echo (isset($user_info['phone']) && ($user_info['phone'] !== '')?$user_info['phone']:''); ?></p>
         <p>收货地址：<?php echo (isset($user_info['province']) && ($user_info['province'] !== '')?$user_info['province']:''); ?> <?php echo (isset($user_info['city']) && ($user_info['city'] !== '')?$user_info['city']:''); ?> <?php echo (isset($user_info['area']) && ($user_info['area'] !== '')?$user_info['area']:''); ?> <?php echo (isset($user_info['addr']) && ($user_info['addr'] !== '')?$user_info['addr']:''); ?></p>
       </div>
             请认真核对您的收货信息，如有错误请联系客服

     </ul>
     <div class="option">
       <span class="info">您可以</span>
        <a href="<?php echo url('api/ucenter/order_list'); ?>" class="J_MakePoint">查看<span>已买到的宝贝</span></a>
     </div>
    </div>
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


</body>
</html>
