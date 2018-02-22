<?php

header("Content-type:text/html;charset=utf-8");

//默认模块
define('__default_module__', 'api');
//默认控制器
define('__default_controller__', 'account');
//默认方法
define('__default_action__', 'index');
//默认禁止访问模块
define('__default_forbid_module__',json_encode(['']));

define('__version__', 'V1.0');//前台版本号
define('__admin_version__', 'V1.0');//后台版本号
// 定义应用目录
define('APP_PATH', __DIR__ . '/../app/');
//网站根目录
define('ROOT_PATH', __DIR__ . '/../');
//前台模版目录
define('TPL_PATH', ROOT_PATH . 'tpl/');

define('NOW_TIME', $_SERVER['REQUEST_TIME']);
//扩展模版目录
define('LIB_ROOM', __DIR__ . '/../app/lib/');

//网站当前路径
define('SITE_PATH', __DIR__."/");

// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';

