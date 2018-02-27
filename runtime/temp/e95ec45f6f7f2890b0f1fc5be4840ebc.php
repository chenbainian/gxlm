<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:36:"./tpl/admin/cate\big_cates_list.html";i:1519484428;}*/ ?>
<option value="">商品大分类</option>
<?php if(is_array($cates) || $cates instanceof \think\Collection): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<option  value="<?php echo $vo['id']; ?>" id="_<?php echo $vo['id']; ?>"><?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?></option>
<?php endforeach; endif; else: echo "" ;endif; ?>
