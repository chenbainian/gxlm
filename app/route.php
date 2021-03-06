<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
/*    '__domain__' => [
        'api2.zhimadaili.com' => 'api',
        'ad.zhimadaili.com' => 'admin',
        'www2.zhimadaili.com' => 'ip',
        'm.zhimadaili.com' => '',
        // 泛域名规则建议在最后定义
//        '*.user'    =>  'user',
//        '*'         => 'book',
    ],*/

    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]' => [
        ':id' => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
