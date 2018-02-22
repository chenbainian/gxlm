<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:30:"./tpl/admin/account/index.html";i:1510742184;}*/ ?>

<!DOCTYPE html>
<html lang="en" class="no-js">

<head>

    <meta charset="utf-8">
    <title>后台登录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="__plugin__/font-awesome/css/font-awesome.min.css" />

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="__plugin__/login_bg/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="__plugin__/login_bg/css/supersized.css" />
    <link rel="stylesheet" type="text/css" href="__plugin__/login_bg/css/style.css" />

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="__plugin__/html5.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="page-container">

    <h1>高校联盟后台管理</h1>


    <form id="form_content" autocomplete="off">
        <input type="text" name="user_login" class="username" placeholder="用户名">
        <input type="password" name="user_pass" class="password" placeholder="密码">
        <button type="button" class="submit_btn">登录</button>
        <div class="error" style="top: 27px;color: #f36; ">
            <span>+</span>
        </div>
    </form>


    <div id="login_container"></div>
</div>


<input type="hidden" id="root_url" value="<?php echo url('index/index'); ?>">
<input type="hidden" id="submit_url" value="<?php echo url('login_do'); ?>">


<!-- Javascript -->
<script type="text/javascript" src="__plugin__/jquery/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="__plugin__/login_bg/js/supersized.3.2.7.min.js"></script>
<script type="text/javascript" src="__plugin__/layer/layer.js"></script>

<script type="text/javascript" src="__static__/public/js/common.js"></script>
<script type="text/javascript" src="__static__/admin/js/account/index.js"></script>

<script>
    if(top.location != location){
        window.top.location.reload();
    }
    $(function(){
        $.supersized({

            // Functionality
            slide_interval     : 3000,    // Length between transitions
            transition         : 1,    // 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
            transition_speed   : 3000,    // Speed of transition
            performance        : 2,    // 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)

            // Size & Position
            min_width          : 0,    // Min width allowed (in pixels)
            min_height         : 0,    // Min height allowed (in pixels)
            vertical_center    : 1,    // Vertically center background
            horizontal_center  : 1,    // Horizontally center background
            fit_always         : 0,    // Image will never exceed browser width or height (Ignores min. dimensions)
            fit_portrait       : 1,    // Portrait images will not exceed browser height
            fit_landscape      : 0,    // Landscape images will not exceed browser width

            // Components
            slide_links        : 'blank',    // Individual links for each slide (Options: false, 'num', 'name', 'blank')
            slides             : [    // Slideshow Images
                {image : '__static__/admin/img/admin/account/index/backgrounds/1.jpg'},
                {image : '__static__/admin/img/admin/account/index/backgrounds/2.jpg'},
                {image : '__static__/admin/img/admin/account/index/backgrounds/3.jpg'}
            ]

        });
        $('.page-container form').submit(function(){
            var username = $(this).find('.username').val();
            var password = $(this).find('.password').val();
            if(username == '') {
                $(this).find('.error').fadeOut('fast', function(){
                    $(this).css('top', '27px');
                });
                $(this).find('.error').fadeIn('fast', function(){
                    $(this).parent().find('.username').focus();
                });
                return false;
            }
            if(password == '') {
                $(this).find('.error').fadeOut('fast', function(){
                    $(this).css('top', '96px');
                });
                $(this).find('.error').fadeIn('fast', function(){
                    $(this).parent().find('.password').focus();
                });
                return false;
            }
        });
        $('.page-container form .username, .page-container form .password').keyup(function(){
            $(this).parent().find('.error').fadeOut('fast');
        });

        /*微信登录*/
        var obj = new WxLogin({
            id:"login_container",
            appid: "<?php echo config('BKG_WEICHAT_LOGIN_APP_ID'); ?>",
            scope: "snsapi_login",
            redirect_uri: "http://ip.mengdie.com/<?php echo url('login_callback',['plat'=>'wechat']); ?>",
        });
    });

    $(".password").keyup(function(o){
        if(o.keyCode==13){
            $(".submit_btn").trigger('click');
        }
    });
    $(".username").keyup(function(o){
        if(o.keyCode==13){
            $(".password").focus();
        }
    });
</script>

</body>

</html>

