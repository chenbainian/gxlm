<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:28:"./tpl/api/account\index.html";i:1519484428;s:29:"./tpl/api/base\common_js.html";i:1519484428;}*/ ?>
<!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<title>登录</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />
		<link rel="stylesheet" type="text/css" href="/public/static/api/AmazeUI-2.4.2/assets/css/amazeui.css" />
		<link href="/public/static/api/css/dlstyle.css" rel="stylesheet" type="text/css">
	</head>

	<body>

		<div class="login-boxtitle">
			<a href="home.html"><img alt="logo" src="/public/static/api/images/logobig.png" /></a>
		</div>

		<div class="login-banner">
			<div class="login-main">
				<div class="login-banner-bg"><span></span><img src="/public/static/api/images/big.jpg" /></div>
				<div class="login-box">

							<h3 class="title">登录商城</h3>

							<div class="clear"></div>
						
						<div class="login-form">
						  <form>
							   <div class="user-name">
								    <label for="user"><i class="am-icon-user"></i></label>
								    <input type="text" name="" id="user" placeholder="用户名">
                 </div>
                 <div class="user-pass">
								    <label for="password"><i class="am-icon-lock"></i></label>
								    <input type="password" name="" id="password" placeholder="请输入密码">
                 </div>
              				</form>
           </div>
            
            <div class="login-links">
                <label for="remember-me"><input id="remember-me" type="checkbox">记住密码</label>

            </div>
								<div class="am-cf">
									<input type="button" id="login" value="登 录" class="am-btn am-btn-primary am-btn-sm">
								</div>


				</div>
			</div>
		</div>


					<div class="footer " style="margin-top: 10%">
						<div class="footer-bd " style="margin-left: 30%">
							<p>
								<a href="# ">关于高校联盟</a>
								<a href="# ">联系我们</a>
								<em>© 2017-2025 gxlm.site 版权所有 </em>
							</p>
						</div>
					</div>
	</body>
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


	<input type="hidden" id="login_url" value="<?php echo url('login_do'); ?>">
	<input type="hidden" id="succ_url" value="<?php echo url('index/index'); ?>">
</html>
<script type="text/javascript">
	$(document).on("click","#login",function(){
		var url = $("#login_url").val();
		var succ_url = $("#succ_url").val();
		var param = {
			username:$("#user").val(),
			password:$("#password").val()
		};
		$.common_ajax(url,param,function(rt){
			layer.msg(rt.msg);
			if(rt.code == 1){
				location.href = succ_url;
			}
		});
	});

</script>