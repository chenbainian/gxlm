<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:36:"./tpl/api/order\ajax_order_list.html";i:1519746660;}*/ ?>
<div class="order-top">
    <div class="th th-item">
        <td class="td-inner">商品</td>
    </div>
    <div class="th th-price">
        <td class="td-inner">单价</td>
    </div>
    <div class="th th-number">
        <td class="td-inner">数量</td>
    </div>
    <div class="th th-operation">
        <td class="td-inner">商品操作</td>
    </div>
    <div class="th th-amount">
        <td class="td-inner">合计</td>
    </div>
    <div class="th th-status">
        <td class="td-inner">交易状态</td>
    </div>
    <div class="th th-change">
        <td class="td-inner">交易操作</td>
    </div>
</div>
<?php if(!(empty($order_list) || ($order_list instanceof \think\Collection && $order_list->isEmpty()))): if(is_array($order_list) || $order_list instanceof \think\Collection): $i = 0; $__LIST__ = $order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<div class="order-main">
    <div class="order-list">

        <!--待发货-->
        <div class="order-status2">
            <div class="order-title">
                <div class="dd-num">订单编号：<a href="javascript:;"><?php echo (isset($vo['order_id']) && ($vo['order_id'] !== '')?$vo['order_id']:''); ?></a></div>
                <span>成交时间：<?php echo date('Y-m-d H:i:s',$vo['create_time']); ?></span>

            </div>
            <div class="order-content">
                <div class="order-left">
                    <?php if(is_array($vo['sub_orders']) || $vo['sub_orders'] instanceof \think\Collection): $i = 0; $__LIST__ = $vo['sub_orders'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?>
                    <ul class="item-list">
                        <li class="td td-item">
                            <div class="item-pic">
                                <a href="#" class="J_MakePoint">
                                    <img src="<?php echo (isset($vo2['img_src']) && ($vo2['img_src'] !== '')?$vo2['img_src']:''); ?>" class="itempic J_ItemImg" style="height: 78px;width: 78px;">
                                </a>
                            </div>
                            <div class="item-info">
                                <div class="item-basic-info">
                                    <a href="#">
                                        <p><?php echo (isset($vo2['goods_name']) && ($vo2['goods_name'] !== '')?$vo2['goods_name']:''); ?></p>
                                        <p class="info-little"><?php echo (isset($vo2['desc']) && ($vo2['desc'] !== '')?$vo2['desc']:''); ?>
                                        <br/>包装：裸装 </p>
                                        <p class="info-little">
                                        <br/>单位：<?php echo (isset($vo2['unit']) && ($vo2['unit'] !== '')?$vo2['unit']:''); ?> </p>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="td td-price">
                            <div class="item-price">
                                <?php echo (isset($vo2['goods_price']) && ($vo2['goods_price'] !== '')?$vo2['goods_price']:0.00); ?>
                            </div>
                        </li>
                        <li class="td td-number">
                            <div class="item-number">
                                <span>×</span><?php echo (isset($vo2['num']) && ($vo2['num'] !== '')?$vo2['num']:''); ?>
                            </div>
                        </li>
                        <li class="td td-operation">
                            <div class="item-operation">
                                <a href=""></a>
                            </div>
                        </li>
                    </ul>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="order-right">
                    <li class="td td-amount">
                        <div class="item-amount">
                            合计：<?php echo (isset($vo2['true_price']) && ($vo2['true_price'] !== '')?$vo2['true_price']:''); ?>
                        </div>
                    </li>
                    <div class="move-right">
                        <li class="td td-status">
                            <div class="item-status">
                                <?php switch($vo['status']): case "1": ?><p class="Mystatus">待接单</p><?php break; case "2": ?><p class="Mystatus">待收货</p><?php break; case "1": ?><p class="Mystatus">已收货</p><?php break; case "1": ?><p class="Mystatus">订单异常</p><?php break; endswitch; ?>
                            </div>
                        </li>
                        <li class="td td-change">
                            <?php switch($vo['status']): case "1": ?><p class="Mystatus"><div class="am-btn am-btn-danger anniu">提醒发货</div></p><?php break; endswitch; ?>

                        </li>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; endif; else: echo "" ;endif; endif; ?>
<?php echo (isset($pages) && ($pages !== '')?$pages:''); ?>