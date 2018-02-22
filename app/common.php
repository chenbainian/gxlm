<?php
/**公共函数类库*/

/*md5加密升级版*/
function md6($str)
{
    return md5(md5($str).config("password_sec"));
}
// 一维数组XSS过滤
function remove_arr_xss($data)
{
    foreach ($data as $k => $v) {
        $data[$k] = trim(remove_xss($v));
    }
    return $data;
}

function is_json($str)
{
    return is_array(json_decode($str, true)) && !empty(json_decode($str));
}


//字符串XSS过滤
function remove_xss($val)
{
    $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);
    $search = 'abcdefghijklmnopqrstuvwxyz';
    $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $search .= '1234567890!@#$%^&*()';
    $search .= '~`";:?+/={}[]-_|\'\\';
    for ($i = 0; $i < strlen($search); $i++) {
        $val = preg_replace('/(&#[xX]0{0,8}' . dechex(ord($search[$i])) . ';?)/i', $search[$i], $val); // with a ;
        $val = preg_replace('/(&#0{0,8}' . ord($search[$i]) . ';?)/', $search[$i], $val); // with a ;
    }

    $ra1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
    $ra2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
    $ra = array_merge($ra1, $ra2);

    $found = true;
    while ($found == true) {
        $val_before = $val;
        for ($i = 0; $i < sizeof($ra); $i++) {
            $pattern = '/';
            for ($j = 0; $j < strlen($ra[$i]); $j++) {
                if ($j > 0) {
                    $pattern .= '(';
                    $pattern .= '(&#[xX]0{0,8}([9ab]);)';
                    $pattern .= '|';
                    $pattern .= '|(&#0{0,8}([9|10|13]);)';
                    $pattern .= ')*';
                }
                $pattern .= $ra[$i][$j];
            }
            $pattern .= '/i';
            $replacement = substr($ra[$i], 0, 2) . '<x>' . substr($ra[$i], 2);
            $val = preg_replace($pattern, $replacement, $val);
            if ($val_before == $val) {
                $found = false;
            }
        }
    }
    return $val;
}

////错误返回值
//function wrong_return($msg = 'error')
//{
//    die_json(array('code' => "-1", 'msg' => $msg), 1);
//}
////正确返回值
//function ok_return($msg = 'success')
//{
//    die_json(array('code' => "1", 'msg' => $msg));
//}


function ok_return($msg = 'success', $code = 1, $ret_data = [])
{
    $arr = [
        'ret' => 0,
        'code' => strval($code),
        'msg' => $msg,
        'ret_data' => $ret_data,
        'timestamp' => time()
    ];
    die_json($arr);
}

function ok_json($msg,$code="1",$data){
    $arr = [
        'ret' => 0,
        'code' => $code,
        'msg' => $msg,
        'data' => $data,
        'timestamp' => time()
    ];
    return json_encode($arr);
}

//BASE64写入图片
function user_img_put($img_prefix,$img){
    $path = "/data/img/upload/".date('ymd');
    $img_name = md5(time());
    $all_path = '.'.$path ;
    if (! is_dir ( $all_path )) {
        mkdir ( $all_path, 0777, true );
    }

    $all_path = $all_path. '/'.$img_name.'.'.$img_prefix;
    $path = $path . '/'.$img_name.'.'.$img_prefix;
    if(!file_put_contents($all_path,$img)){
        return false;
    }else{
        return array(
            "path"=>$path,
            "ext"=>$img_prefix,
            'name'=>$img_name
        );
    }
}

function wrong_return($msg = 'failed', $code = -1, $ret_data = [])
{
    $arr = [
        'ret' => 1,
        'code' => strval($code),
        'msg' => $msg,
        'ret_data' => $ret_data,
        'timestamp' => time()
    ];
    die_json($arr, 1);
}

function rt($msg = '', $code = 0, $ret = 1, $ret_data = [])
{
    $arr = [
        'ret' => $ret,
        'code' => strval($code),
        'msg' => $msg,
        'ret_data' => $ret_data
    ];
    return $arr;
}

//通用返回值
function com_return($code = 300, $msg = 'error')
{
    die_json(array('code' => $code, 'msg' => $msg, 'timestamp' => time()));
}

//本站签名方法
function sign_by_key($arr = array('uid' => '', 'timestamp' => ''))
{
    $uid = empty($uid) ? 0 : $arr['uid'];
    $timestamp = empty($arr['timestamp']) ? microtime() : $arr['timestamp'];
    $key = config('union_sign_key');
    return md5($uid . $timestamp . $key);
}

/*数组返回json
字符串返回code=字符串
type存在,返回中文**/
function rt_json($post, $type = null, $msg = null)
{

    if (is_array($post)) {
        if ($type) return json_encode($post, JSON_UNESCAPED_UNICODE);
        return json_encode($post);
    } else {
        $tmp = array(
            "code" => $post
        );
        if (!empty($msg)) {
            $tmp['msg'] = $tmp;
        }
        if ($type) return json_encode($tmp, JSON_UNESCAPED_UNICODE);
        return json_encode($tmp);
    }
}

//输入json并且结束
function die_json($post, $type = null)
{
    die(rt_json($post, $type));
}

//跳转
function jump_url($url)
{
    header("Location: " . $url);
    die();
}

/**
 * MD5 验签
 * @param $prestr
 * @param $sign
 * @param $key
 * @return bool
 */
function md5Verify($prestr, $sign, $key)
{
    $prestr = $prestr . $key;
    $mysgin = md5($prestr);

    if ($mysgin == $sign) {
        return true;
    } else {
        return false;
    }
}

function getHttpResponseGET($url, $cacert_url)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, 0); // 过滤HTTP头
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);// 显示输出结果
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);//SSL证书认证
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);//严格认证
    curl_setopt($curl, CURLOPT_CAINFO, $cacert_url);//证书地址
    $responseText = curl_exec($curl);
    //var_dump( curl_error($curl) );//如果执行curl过程中出现异常，可打开此开关，以便查看异常内容
    curl_close($curl);

    return $responseText;
}


function rsaSign($data, $private_key)
{
//    $priKey = file_get_contents($private_key);
    $private_key = str_replace("-----BEGIN RSA PRIVATE KEY-----", "", $private_key);
    $private_key = str_replace("-----END RSA PRIVATE KEY-----", "", $private_key);
    $private_key = str_replace("\n", "", $private_key);

    $private_key = "-----BEGIN RSA PRIVATE KEY-----" . PHP_EOL . wordwrap($private_key, 64, "\n", true) . PHP_EOL . "-----END RSA PRIVATE KEY-----";

    $res = openssl_get_privatekey($private_key);

    if ($res) {
        openssl_sign($data, $sign, $res);
    } else {
        echo "您的私钥格式不正确!" . "<br/>" . "The format of your private_key is incorrect!";
        exit();
    }
    openssl_free_key($res);
    //base64编码
    $sign = base64_encode($sign);
    return $sign;
}

/**
 * 通过ip获取 经度
 * @param $ip
 * @return mixed
 */
function get_logitude_by_ip($ip)
{
    $content = file_get_contents('http://api.map.baidu.com/location/ip?ak=VG6iXiGeteFcckytpiCsQLdMKdWUKBI4&ip=' . $ip . '&coor=bd09ll');
    $json = json_decode($content);
    return $json->{'content'}->{'point'}->{'x'};//按层级关系提取经度数据

}

function get_conf($code)
{
    $m_conf = new \app\core\model\CommonModel();
    return $m_conf->get_conf($code);
}


/**
 * 通过ip获取 纬度
 * @param $ip
 * @return mixed
 */

function get_latitude_by_ip($ip)
{
    $content = file_get_contents('http://api.map.baidu.com/location/ip?ak=VG6iXiGeteFcckytpiCsQLdMKdWUKBI4&ip=' . $ip . '&coor=bd09ll');
    $json = json_decode($content);
    return $json->{'content'}->{'point'}->{'y'};//按层级关系提取纬度数据
}

/**
 * 检验手机号是否符合规范
 * @param $phone
 * @return bool
 */
function checkPhone($phone)
{
    if (preg_match("/^1\\d{10}$/", $phone)) {
        return true;
    } else {
        return false;
    }
}

//输入日志信息
function log_w($txt = '', $flag = '')
{
    if (!is_string($txt)) {
        $txt = json_encode($txt);
    }
    if (!empty($flag)) {
        $txt = '[' . $flag . ']' . $txt;
    }
    return db_func('log', 'md_')->insert(['text' => $txt, 'create_time' => date('Y-m-d H:i:s')]);
}

//返回数组
function exit_array($code, $status, $message = '', $data = '', $extData = array())
{
    $result = array(
        'code' => $code,
        'success' => $status == 1 ? true : false,
        'msg' => $message,
    );

    if (!empty($data) && is_array($data)) $result['data'] = $data;//可以返回空数组

    // 扩展数据追加到列表
    if (!empty($extData) && is_array($extData)) {
        foreach ($extData as $key => $value) {
            $result[$key] = $value;
        }
    }

    return $result;
    // echo $json;
    // exit;
}

//返回验证码地址
function verify_url()
{
    return url('core/api/verify') . "?&amp;time";
}

/**
 * 把返回的数据集转换成Tree
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0)
{
    // 创建Tree
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] =& $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] =& $list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    $parent[$child][] =& $list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * 将list_to_tree的树还原成列表
 * @param  array $tree 原来的树
 * @param  string $child 孩子节点的键
 * @param  string $order 排序显示的键，一般是主键 升序排列
 * @param  array $list 过渡用的中间数组，
 * @return array        返回排过序的列表数组
 * @author yangweijie <yangweijiester@gmail.com>
 */
function tree_to_list($tree, $child = '_child', $order = 'id', &$list = array())
{
    if (is_array($tree)) {
        foreach ($tree as $key => $value) {
            $reffer = $value;
            if (isset($reffer[$child])) {
                unset($reffer[$child]);
                tree_to_list($value[$child], $child, $order, $list);
            }
            $list[] = $reffer;
        }
        $list = list_sort_by($list, $order, $sortby = 'asc');
    }
    return $list;
}

//获取客户真实ip
function get_client_ip_true()
{
    if (isset($_SERVER)) {
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } else {
            $ip = getenv("REMOTE_ADDR");
        }
    }
    return $ip;
}

/**
 * 通过主键ID 获取member 信息
 * @param $id
 * @return bool
 */
function get_member_info_by_id($id)
{
    if ($id) {
        Return db('member')->cache(true)->where('member_id', $id)->find();
    } else {
        return false;
    }

}

/**
 * 判断是否是吉祥号
 */

function checkGoodNum($num)
{
    return false;//此处回头写一些吉祥号的规则，判断是否是吉祥号,朴老板给我留一个
}

/**
 * 通过主键ID 获取话题信息
 * @parameter $id
 * @return mixed
 */
function get_topic_by_id($id)
{
    if (empty($id)) return false;
    return db('topic')->cache(true)->where(array('id' => $id))->find();
}


function get_member_info_by_phone($phone)
{
    if (empty($phone)) return false;
    return db('member')->cache(true)->where('phone', $phone)->find();

}

/**
 * 验证码检查，验证完后销毁验证码增加安全性 ,<br>返回true验证码正确，false验证码错误
 * @return boolean <br>true：验证码正确，false：验证码错误
 */
function sp_check_verify_code()
{
    $request = get_all_input();
    if (!empty($request['verify'])) {
        $verify_code = $request['verify'];
    } else return false;
    if (!empty($verify_code)) {
        $verify = new \org\Verify();
        return $verify->check($verify_code, "");
    }
    return false;
}

/**
 * 获取客户端操作系统信息包括win10
 * @author  Jea杨
 * @return string
 */
function get_os()
{
    $agent = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match('/win/i', $agent) && strpos($agent, '95')) {
        $os = 'Windows 95';
    } else if (preg_match('/win 9x/i', $agent) && strpos($agent, '4.90')) {
        $os = 'Windows ME';
    } else if (preg_match('/win/i', $agent) && preg_match('/98/i', $agent)) {
        $os = 'Windows 98';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 6.0/i', $agent)) {
        $os = 'Windows Vista';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 6.1/i', $agent)) {
        $os = 'Windows 7';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 6.2/i', $agent)) {
        $os = 'Windows 8';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 10.0/i', $agent)) {
        $os = 'Windows 10';#添加win10判断
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 5.1/i', $agent)) {
        $os = 'Windows XP';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 5/i', $agent)) {
        $os = 'Windows 2000';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt/i', $agent)) {
        $os = 'Windows NT';
    } else if (preg_match('/win/i', $agent) && preg_match('/32/i', $agent)) {
        $os = 'Windows 32';
    } else if (preg_match('/linux/i', $agent)) {
        $os = 'Linux';
    } else if (preg_match('/unix/i', $agent)) {
        $os = 'Unix';
    } else if (preg_match('/sun/i', $agent) && preg_match('/os/i', $agent)) {
        $os = 'SunOS';
    } else if (preg_match('/ibm/i', $agent) && preg_match('/os/i', $agent)) {
        $os = 'IBM OS/2';
    } else if (preg_match('/Mac/i', $agent) && preg_match('/PC/i', $agent)) {
        $os = 'Macintosh';
    } else if (preg_match('/PowerPC/i', $agent)) {
        $os = 'PowerPC';
    } else if (preg_match('/AIX/i', $agent)) {
        $os = 'AIX';
    } else if (preg_match('/HPUX/i', $agent)) {
        $os = 'HPUX';
    } else if (preg_match('/NetBSD/i', $agent)) {
        $os = 'NetBSD';
    } else if (preg_match('/BSD/i', $agent)) {
        $os = 'BSD';
    } else if (preg_match('/OSF1/i', $agent)) {
        $os = 'OSF1';
    } else if (preg_match('/IRIX/i', $agent)) {
        $os = 'IRIX';
    } else if (preg_match('/FreeBSD/i', $agent)) {
        $os = 'FreeBSD';
    } else if (preg_match('/teleport/i', $agent)) {
        $os = 'teleport';
    } else if (preg_match('/flashget/i', $agent)) {
        $os = 'flashget';
    } else if (preg_match('/webzip/i', $agent)) {
        $os = 'webzip';
    } else if (preg_match('/offline/i', $agent)) {
        $os = 'offline';
    } else {
        $os = '未知操作系统';
    }
    return $os;
}

//检测是否为post
function is_post()
{
    $request = \think\Request::instance();
    return $request->isPost();
}

//检测是否为post
function is_ajax_post()
{
    $request = \think\Request::instance();
    return $request->isAjax() && $request->isPost();
}

//验证信息
function validate_rule($type = null, $str = 'null')
{
    if (empty($type) || empty($str)) return false;
    switch ($type) {
        case 'id':
            $rgx = '/[a-zA-Z0-9_]/';
            break;
        case 'username':
            $rgx = '/[a-zA-Z0-9_]/';
            break;
        case 'password':
            $rgx = '/[a-zA-Z0-9_]/';
            break;
        case 'phone':
            $rgx = '/[1][3-9][0-9]{9}/';
            break;
        default:
            $rgx = '/.*/';
    }

    if (!preg_match($rgx, $str)) return false;
    return true;
}


//字符串转数组去空
function str_to_arr($str, $split = ",")
{
    $arr = explode($split, $str);
    $arr = array_filter($arr);
    return $arr;
}

//字符串去空逗号分割
function str_implode($str, $split = ",")
{
    $arr = explode($split, $str);
    $arr = array_filter($arr);
    return implode(",", $arr);
}

//对象转数组
function obj_to_arr($obj)
{
    return json_decode(json_encode($obj), true);
}

//实例化数据库,
function db_func($str = null, $pre_fix = null, $connect = null)
{
    if (!empty($pre_fix)) {
        if (!empty($connect)) {
            return \think\Db::connect($connect)->table($pre_fix . $str);
        }
        return \think\Db::table($pre_fix . $str);
    }
    if (!empty($connect)) {
        return \think\Db::connect($connect)->name($str);
    }

    return \think\Db::name($str);
}

//检测id的值是否正确
function chk_id($id, $allow_zero = false)
{
    if ($allow_zero) {
        if (empty($id) && $id !== 0) return false;
    } else {
        if (empty($id)) return false;
    }

    if (!is_numeric($id)) return false;
    return true;
}

function get_all()
{
    $arr_1 = input('param.', []);
    $arr_2 = input('request.', []);
    return array_merge($arr_1, $arr_2);
}

//数组转换字符串去重
function arr_to_str($arr, $filter = true, $glue = ',')
{
    if ($filter) {
        $arr = array_filter($arr);
    }
    return implode($glue, $arr);
}

/*
 * 生成随机数加强版
 * @param $k 生成随机数字的模式,n为数字,s为字符串,r为字符串或数字
 * @param $n 生成随机数字长度
 * @return 生成的随机数
 * */
function rand_str($k = 'n', $n = 6)
{
    $r = "";

    switch (strtolower($k)) {
        case "n":
            $pattern = '1234567890';
            $length = 9;
            break;
        case "s":
            $pattern = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
            $length = 52;
            break;

        case "r":
            $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
            $length = 62;
            break;
        default:
            $pattern = '1234567890';
            $length = 9;
            break;
    }

    for ($i = 0; $i < $n; $i++) {
        $r .= $pattern{mt_rand(0, $length)};    //生成php随机数
    }
    return $r;
}

function sort_line_by_pass_code($a,$b){
    if($a['pass_code'] == "local" && $b['pass_code'] != "local") return -1;
    if($a['pass_code'] == $b['pass_code']) return 0;
    return 1;
}


//生成全局唯一订单号
function create_order_num($i = '')
{
    return date("ymdhis") . mt_rand(1000, 9999) . $i;
}

function get_admin_role()
{
    return session('admin.role_list');
}

function arr2str($arr, $glue = ',')
{
    return implode($glue, $arr);
}

//获取session内容
function get_session($key)
{
    return session('admin.' . $key);
}

//删除当前文件夹以及文件目录下的文件
function deldir($dir)
{
    //先删除目录下的文件：
    $dh = opendir($dir);
    while ($file = readdir($dh)) {
        if ($file != "." && $file != "..") {
            $fullpath = $dir . "/" . $file;
            if (!is_dir($fullpath)) {
                unlink($fullpath);
            } else {
                deldir($fullpath);
            }
        }
    }

    closedir($dh);
    //删除当前文件夹：
    if (rmdir($dir)) {
        return true;
    } else {
        return false;
    }
}

//数组转get格式
function arr2get($para)
{
    $arg = "";
    while (list ($key, $val) = each($para)) {
        $arg .= $key . "=" . urlencode($val) . "&";
    }

    //去掉最后一个&字符
    $arg = substr($arg, 0, count($arg) - 2);

    //如果存在转义字符，那么去掉转义
    if (get_magic_quotes_gpc()) {
        $arg = stripslashes($arg);
    }

    return $arg;
}

//模拟get请求
function curl_get($url)
{
    //初始化
    $ch = curl_init();

    //设置选项，包括URL
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    //执行并获取HTML文档内容
    $output = curl_exec($ch);

    //释放curl句柄
    curl_close($ch);

    //返回获得的数据
    return $output;
}

//除去数组中的空值和签名参数
function paraFilter($para)
{
    $para_filter = array();
    while (list ($key, $val) = each($para)) {
        if ($key == "sign" || $key == "sign_type" || $val == "") continue;
        else    $para_filter[$key] = $para[$key];
    }
    return $para_filter;
}

/**
 * 对数组排序
 * @param $para 排序前的数组
 * @return 排序后的数组
 */
function argSort($para)
{
    ksort($para);
    reset($para);
    return $para;
}

/**
 * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
 * @param $para 需要拼接的数组
 * @return 拼接完成以后的字符串
 */
function createLinkstring($para)
{
    $arg = "";
    while (list ($key, $val) = each($para)) {
        $arg .= $key . "=" . $val . "&";
    }
    //去掉最后一个&字符
    $arg = substr($arg, 0, count($arg) - 2);

    //如果存在转义字符，那么去掉转义
    if (get_magic_quotes_gpc()) {
        $arg = stripslashes($arg);
    }

    return $arg;
}

//die_json函数的进一步封装
function die_result($code = null, $msg = null, $flag = null)
{
    if ($flag == 1) {
        return array("code" => $code, 'msg' => $msg);
    } else {
        die_json(array("code" => $code, 'msg' => $msg), 1);
    }

}

/**
 * RSA验签
 * @param $data 待签名数据
 * @param $ali_public_key_path 支付宝的公钥文件路径
 * @param $sign 要校对的的签名结果
 * return 验证结果
 */
function rsaVerify($data, $alipay_public_key, $sign)
{
    $alipay_public_key = str_replace("-----BEGIN PUBLIC KEY-----", "", $alipay_public_key);
    $alipay_public_key = str_replace("-----END PUBLIC KEY-----", "", $alipay_public_key);
    $alipay_public_key = str_replace("\n", "", $alipay_public_key);

    $alipay_public_key = '-----BEGIN PUBLIC KEY-----' . PHP_EOL . wordwrap($alipay_public_key, 64, "\n", true) . PHP_EOL . '-----END PUBLIC KEY-----';
    $res = openssl_get_publickey($alipay_public_key);
    if ($res) {
        $result = (bool)openssl_verify($data, base64_decode($sign), $res);
    } else {
        log_w("您的支付宝公钥格式不正确!" . "<br/>" . "The format of your alipay_public_key is incorrect!");
        exit();
    }
    openssl_free_key($res);
    return $result;
}

/**
 * 鉴定权限签名
 * @param string $order_id 订单号id
 * @param string $timestamp 时间戳
 * @param string $sign 签名
 * @return bool
 */
//function auth($order_id, $timestamp, $sign)
//{
//    //获取系统公钥
//    $key = Config('TOKEN_ACCESS');
//    //鉴权密码
//    $token = md5($order_id . $timestamp . $key);
//    //权限校验失败
//    if ($sign !== $token) return rt("-100", $token);
//    //时间戳超时
//    if (NOW_TIME - $timestamp > 7200) return rt("-200", date("Y-m-d H:i:s"));
//    return rt("1", "成功");
//}

////返回信息的封装
//function rt($code = null, $val = null, $msg = null)
//{
//    if (!empty($msg)) {
//        log_w($msg);
//    }
//    return array("code" => $code, "value" => $val);
//}


function chk($type, $value)
{
    switch ($type) {
        case 'id':
            (empty($value) || !preg_match(config('regular_rule')['id'], $value)) && wrong_return('参数id格式错误');
            break;
        case 'username':
            (empty($value) || !preg_match(config('regular_rule')['username'], $value)) && wrong_return('用户名格式不正确');
            break;
        case 'password':
            (empty($value) || !preg_match(config('regular_rule')['password'], $value)) && wrong_return('密码格式不正确');
            break;
        case 'email':
            (empty($value) || !preg_match(config('regular_rule')['email'], $value)) && wrong_return('email格式不正确');
            break;
        default:
            wrong_return('参数异常');
    }
}

//获取当前域名
function get_domain()
{
    return $_SERVER['HTTP_HOST'];
}


//根据秒,返回指定类型的计量单位
function rt_time_format($type, $sec)
{
    switch ($type) {
        case "year":
            return round($sec / (86400 * 365), 1);
        case "month":
            return round($sec / (86400 * 30), 1);
        case "week":
            return round($sec / (86400 * 7), 1);
        case "day":
            return round($sec / 86400, 1);
        case "hour":
            return round($sec / 3600, 1);
        case "min":
            return round($sec / 60, 1);
        case "sec":
            return round($sec, 0);
        default :
            return false;
    }
}

//根据秒,自动返回计量单位
function rt_auto_sec($sec)
{
    switch ($sec) {
        case ($sec > 0 && $sec <= 60):
            return rt_time_format('sec', $sec) . '秒';
        case ($sec >= 60 && $sec < 3600):
            return rt_time_format('min', $sec) . '分钟';
        case ($sec >= 3600 && $sec < 86400):
            return rt_time_format('hour', $sec) . '小时';
        case ($sec >= 86400 && $sec < (86400 * 7)):
            return rt_time_format('day', $sec) . '天';
        case ($sec >= (86400 * 7) && $sec < (86400 * 30)):
            return rt_time_format('week', $sec) . '周';
        case ($sec >= (86400 * 30) && $sec < (86400 * 365)):
            return rt_time_format('month', $sec) . '月';
        case ($sec >= (86400 * 365)):
            return rt_time_format('year', $sec) . '年';
        default:
            return false;
    }
}


//根据秒,自动返回计量单位
function rt_auto_sec_split_type($sec)
{
    if ($sec <= 0)
        return ['time' => '已过期', 'type' => ''];
    if ($sec > 0 && $sec <= 60)
        return ['time' => rt_time_format('sec', $sec), 'type' => '秒'];
    if ($sec >= 60 && $sec < 3600)
        return ['time' => rt_time_format('min', $sec), 'type' => '分钟'];
    if ($sec >= 3600 && $sec < 86400)
        return ['time' => rt_time_format('hour', $sec), 'type' => '小时'];
    if ($sec >= 86400 && $sec < (86400 * 7))
        return ['time' => rt_time_format('day', $sec), 'type' => '天'];
    if ($sec >= (86400 * 7) && $sec < (86400 * 30))
        return ['time' => rt_time_format('week', $sec), 'type' => '周'];
    if ($sec >= (86400 * 30) && $sec < (86400 * 365))
        return ['time' => rt_time_format('month', $sec), 'type' => '月'];
    if ($sec >= (86400 * 365))
        return ['time' => rt_time_format('year', $sec), 'type' => '年'];
    return ['time' => $sec, 'type' => '秒'];
}


//根据M,返回指定类型的计量单位
function rt_flow_format($type, $sec)
{
    switch ($type) {
        case "G":
            return round($sec / (1024 * 1024), 2);
        case "M":
            return round($sec / 1024, 2);
        case "K":
            return round($sec, 0);
        default :
            return false;
    }
}

//根据M,自动返回计量单位

function rt_auto_megabytes($sec)
{
    switch ($sec) {
        case ($sec >= 0 && $sec <= 1024):
            return rt_flow_format('K', $sec) . 'K';
        case ($sec >= 1024 && $sec < (1024 * 1024)):
            return rt_flow_format('M', $sec) . 'M';
        case ($sec >= (1024 * 1024)):
            return rt_flow_format('G', $sec) . 'G';
        default:
            return false;
    }
}

//根据请求类型,返回时间秒
function get_sec_by_type_val($type, $value)
{
    switch ($type) {
        case 'sec':
            return $value;
        case 'min':
            return ceil($value * 60);
        case 'hour':
            return ceil($value * 3600);
        case 'day':
            return ceil($value * 86400);
        case 'week':
            return ceil($value * 604800);
        case 'month':
            return ceil($value * 2592000);
        case 'year':
            return ceil($value * 31536000);
        default:
            return false;
    }
}

//签名exec_data
function sign_exec_data($exec_data)
{

    if (!empty($exec_data['MD5'])) {
        unset($exec_data['MD5']);
    }

    $exec_data = array_filter($exec_data);//删除全部空值
    $exec_data = argSort($exec_data);
    $exec_data = createLinkstring($exec_data);
    return md5(json_encode($exec_data) . config('union_sign_key'));
}

function chk_login($flag)
{
    //未登录跳转
    if (!$flag) {
        if (!is_user_login()) {
            header('Location: /login/');
        }
    } else {
        if (is_user_login()) {
            header('Location: /ucenter/');
        }
    }

}

function user_group()
{
    if (is_user_login()) {
        $user_group = session("user.user_group");
        if (!empty($user_group)) {
            return (string)$user_group;
        } else {
            return false;
        }
    } else return false;

}


function get_user_open_id()
{
    $we_info = session('wechat_info');
    return empty($we_info['openid']) ? 0 : $we_info['openid'];
}




function check_empty($value,$type='str'){
    if(empty($value)){
        if($type == "int"){
            return 0;
        }else{
            return "";
        }

    }else{
        return $value;
    }
}

//获取user登录信息
function user_info()
{
    return session("user");
}

function md5_sign($post)
{

    unset($post['sign']);
    unset($post['sign_type']);
    $data = paraFilter($post);//删除全部空值
    $data = argSort($data);
    $str = createLinkstring($data);

    $str = trim($str, '&') . config('ALIPAY_MD5_TOKEN');
    $rt = array(
        'param' => $data,
        'sign' => md5($str)
    );
    return $rt;
}


/**
 * 生成微信签名
 * @return string 签名，本函数不覆盖sign成员变量，如要设置签名需要调用SetSign方法赋值
 */
function MakeSign($arr, $key = '')
{
    if (empty($arr['appid'])) {
        log_w('微信签名appid不能为空' . json_encode($arr));
    }
    if (!defined('WX_TYPE')) {
        if ($arr['appid'] === config('WECHAT_OPEN_APP_ID')) {
            define('WX_TYPE', 'open');
        } elseif ($arr['appid'] === config('WECHAT_PUBLIC_APP_ID_PAY')) {
            define('WX_TYPE', 'public');
        } else {
            log_w('定义WX_TYPE失败');
        }
    }
    if (empty($key)) {
        require "../extend/org/wechat/lib/WxPay.Config.php";
        $key = \WxPayConfig::get_conf()['KEY'];
    }
    !is_array($arr) && wrong_return('参数应该为数组');
    //签名步骤一：按字典序排序参数
    ksort($arr);
    $string = ToUrlParams($arr);
    //签名步骤二：在string后加入KEY
    $string = $string . "&key=" . $key;
    //签名步骤三：MD5加密
    $string = md5($string);
    //签名步骤四：所有字符转为大写
    return strtoupper($string);
}


/**
 * 格式化参数格式化成url参数
 */
function ToUrlParams($arr)
{
    $buff = "";
    foreach ($arr as $k => $v) {
        if ($k != "sign" && $v != "" && !is_array($v)) {
            $buff .= $k . "=" . $v . "&";
        }
    }

    $buff = trim($buff, "&");
    return $buff;
}

//返回当前的一些信息，如ACTION_NAME
function get_now($type)
{
    $request = \think\Request::instance();
    switch ($type) {
        case 'm':
            return $request->module();
        case 'c':
            return $request->controller();
        case 'a':
            return $request->action();
    }
}


//按照类型返回对应的支付通知反馈信息
function rt_notice_info($plat, $msg = '', $order_id = '')
{
    if (!empty($msg)) {
        log_w($msg, $order_id);
    }
    switch ($plat) {
        case "alipay":
            die('SUCCESS');
            break;
        case "wechat":
            die('<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>');
        case "agent":
            die_json(['code' => 1, "msg" => "充值成功"]);
            break;
        default:
            die('SUCCESS');
    }
}


/////////////////////////////////////

function get_origin()
{
    return empty(input('get.q', '')) ? $_SERVER['HTTP_HOST'] : input('get.q', '');
}


/*
*@通过curl方式获取指定的图片到本地
*@ 完整的图片地址
*@ 要存储的文件名
*/
function get_remote_img($url = "", $filename = "")
{
    //去除URL连接上面可能的引号
    //$url = preg_replace( '/(?:^['"]+|['"/]+$)/', '', $url );
    $hander = curl_init();
    $fp = fopen($filename, 'wb');
    curl_setopt($hander, CURLOPT_URL, $url);
    curl_setopt($hander, CURLOPT_FILE, $fp);
    curl_setopt($hander, CURLOPT_HEADER, 0);
    curl_setopt($hander, CURLOPT_FOLLOWLOCATION, 1);
    //curl_setopt($hander,CURLOPT_RETURNTRANSFER,false);//以数据流的方式返回数据,当为false是直接显示出来
    curl_setopt($hander, CURLOPT_TIMEOUT, 60);
    curl_exec($hander);
    curl_close($hander);
    fclose($fp);
    return true;
}

function get_all_input()
{
    $inout_1 = input('param.', []);
    $inout_2 = input('request.', []);
    $input_3 = json_decode(file_get_contents('php://input'), true);
    if (!is_array($input_3)) $input_3 = array();

    if (empty($inout_1) && empty($inout_2) && empty($input_3)) return array();
    return $data = array_merge($inout_1, $inout_2, $input_3);
}

//转换gbk gb2312为utf8
function gbk2utf8($str)
{
    $charset = mb_detect_encoding($str, array('UTF-8', 'GBK', 'GB2312'));
    $charset = strtolower($charset);
    if ('cp936' == $charset) {
        $charset = 'GBK';
    }
    if ("utf-8" != $charset) {
        $str = mb_convert_encoding($str, "UTF-8", "GBK");
    }
    return $str;
}


//计算时间的开通方式
function exec_renew_type($time)
{
    $time = intval($time);
    $time = $time / 86400 / 30;
    $month = intval($time);

    $time = ($time - $month) * 30 / 7;
    $week = intval($time);

    $day = intval($time * 7);
    return [
        'month' => $month,
        'week' => $week,
        'day' => $day,
    ];
}


/**
 * 获取当前时间戳，精确到毫秒,如果包含参数,格式为'2016-10-5 12:12:12.538'则转换为参数的时间戳
 * @param string $time 精确到毫秒的时间
 * @return int 返回值
 */
function microtime_float($time = null)
{
    if ($time) {
        $tmp = explode('.', $time);
        if (empty($tmp[1])) $m_time = strtotime($tmp[0]);
        else $m_time = strtotime($tmp[0]) . substr($tmp[1], 0, 3);
    } else {
        list($usec, $sec) = explode(" ", microtime());
        $time = ((float)$usec + (float)$sec) * 1000;
        $m_time = round($time, 0);
    }
    return $m_time;
}


//异或加密,组装成json,自动加上时间戳作为key
function md_encode($str, $key = null)
{
    //当前时间戳+有效期延迟,13位
    $time = strval(microtime_float() + intval(config('api_expire_sec') * 1000));
    //随机13位字符串
    $rand_str = rand_str('r', 13);

    //base64转码待加密内容
    $str = base64_encode($str);

    //获取交换密钥key
    $key = empty($key) ? config('xor_key') : $key;
    //生成随机key
    $rand_key = strtolower(md5($time . $rand_str . $key));

    //用随机字符加密,并且在尾部拼上异或的时间戳,格式为:解密内容+13位时间戳加密内容(随机13位字符串异或加密)+随机13位字符串(交换key异或加密)
    $str_xor = md_xor($str, $rand_key) . md_xor($time, $rand_str) . md_xor($rand_str, $key);
    //转换为base64格式编码
    return base64_encode($str_xor);
}

//异或解密
function md_decode($str, $key = null)
{
    $str = str_replace(' ', '+', $str);
    //base64解码待加密内容
    $str = base64_decode($str);

    //获取交换密钥key
    $key = empty($key) ? config('xor_key') : $key;

    //分离加密内容,随机密钥,随机字符串
    $len = strlen($str);
    //13位字符串分离
    $rand_str = md_xor(substr($str, $len - 13, 13), $key);

    //13位时间戳
    $time = md_xor(substr($str, $len - 26, 13), $rand_str);

    //if ($time - microtime_float() <= 0) wrong_return('api expire');
    //生成随机key
    $rand_key = strtolower(md5($time . $rand_str . $key));
    //还原数据
    $str_xor = md_xor(substr($str, 0, $len - 26), $rand_key);
    return base64_decode($str_xor);
}

//字符串异或
function md_xor($str, $key = null)
{
    $len = strlen($str);
    $k_len = strlen($key);

    $s = '';
    for ($i = 0; $i < $len; $i++) {
        $tmp = substr($str, $i, 1);
        //当前异或的位数
        $tmp_key = $key[$i % $k_len];
        $s .= $tmp ^ $tmp_key;
    }
    return $s;

}


//更新用户session缓存
function cache_session($session_id, $expire_time, $enable = 'true')
{
    //缓存销毁时间
    $cache_time = 86400;
    $tag = 'session_id-' . $session_id;
    //心跳写入次数
    $times = intval(\think\Cache::get($tag . 'times'));
    if (!isset($times)) {
        \think\Cache::tag($tag)->set($tag . 'times', 0, $cache_time);
    } //每100次更新一次数据库
    elseif ($times >= 100) {
        \think\Cache::tag($tag)->set($tag . 'times', 0, $cache_time);
        db_func('session', 'md_')->where(['session_id' => $session_id])->update(['expire_time' => $expire_time]);
    } else {
        \think\Cache::tag($tag)->set($tag . 'times', (intval($times) + 1), $cache_time);
    }

    $r2 = false;
    $r1 = \think\Cache::tag($tag)->set($tag . 'expire_time', $expire_time, $cache_time);
    $r1 && ($r2 = \think\Cache::tag($tag)->set($tag . 'enable', $enable, $cache_time));
    return $r1 && $r2;
}

//检测用户的session当前是否可用
function chk_session_enable($session_id)
{
    $tag = 'session_id-' . $session_id;
    $expire_time = \think\Cache::get($tag . 'expire_time');
    $enable = \think\Cache::get($tag . 'enable');
    //如果缓存不存在,从数据库查询一次
    if (empty($expire_time)) {
        $info = db_func('session', 'md_')->where(['session_id' => $session_id])->field(['expire_time', 'enable'])->find();
        if (empty($info)) return false;
        $expire_time = $info['expire_time'];
        $enable = $info['enable'];
        //写入缓存
        cache_session($session_id, $expire_time, $enable);
    }

    return (($expire_time > NOW_TIME) && $enable === 'true');
}

//清空用户session缓存
function clear_session($session_id)
{
    $tag = 'session_id-' . $session_id;
    // 清除tag标签的缓存数据
    \think\Cache::clear($tag);
}

function get_client_ip($type = 0)
{
    $type = $type ? 1 : 0;
    static $ip = NULL;
    if ($ip !== NULL) return $ip[$type];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos = array_search('unknown', $arr);
        if (false !== $pos) unset($arr[$pos]);
        $ip = trim($arr[0]);
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = ip2long($ip);
    $ip = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}

function js_encode($str){
    //当前时间戳+有效期延迟,13位
    $time = strval(microtime_float() + intval(config('api_expire_sec') * 1000));
    //key长度256位
    $key = rand_str('r', 256) . $time;
    $rand_key = strtolower(md5($key));
    $str = base64_encode($str);
    $str_encode = com_xor($str, $rand_key);
    $key = com_xor($key, $str_encode);
    $s = $str_encode . $key;
    $t = "";
    for ($i = 0; $i < strlen($s); $i++) {
        $t = $t . ord($s[$i]) . '|';
    }

    return base64_encode($t);
}

//字符串异或
function com_xor($str, $key = null)
{
    $len = strlen($str);
    $k_len = strlen($key);
    $s = '';
    for ($i = 0; $i < $len; $i++) {
        $tmp = substr($str, $i, 1);
        //当前异或的位数
        $tmp_key = $key[$i % $k_len];
        $s .= $tmp ^ $tmp_key;
    }
    return $s;

}

//检测已经登录用户密码
function chk_login_user_pass($pass)
{
    $id = get_user_id();
    if (empty($id)) return false;
    $u_info = db_func('users')->where(["id" => get_user_id()])->field('username,password')->find();
    $user_pass = \org\Crypt::decrypt($u_info['password'], $u_info['username']);
    return ($user_pass === $pass);
}

//检测用户和密码
function chk_user_pass($username, $password)
{
    if (empty($username) || empty($password)) return false;
    $u_info = db_func('users')->where(["username" => $username])->field('username,password')->find();
    return (\org\Crypt::encrypt($password, $u_info['username']) === $u_info['password']);
}

//检测用户和密码
function chk_user_pass_md5($username, $password)
{
    if (empty($username) || empty($password)) return false;
    $u_info = db_func('users')->where(["username" => $username])->field('username,password')->find();
    return md5(\org\Crypt::decrypt($u_info['password'], $u_info['username'])) === strtolower($password);
}

//返回用户真实密码
function rt_user_pass($password, $username)
{
    return \org\Crypt::decrypt($password, $username);

}

//根据终端数打折
function discount_by_buy_num($price, $buy_num)
{
    if ($buy_num >= 3 && $buy_num < 5) $price = floatval($price) * 0.924074;
    if ($buy_num >= 5 && $buy_num < 10) $price = floatval($price) * 0.7766666;
    if ($buy_num >= 10) $price = floatval($price) * 0.72166666;
    return $price;
}

//检测用户是否过期,过期执行操作用户过期,设置用户终端数为1
function chk_user_exp_and_exec($username, $expire_time = 'no')
{
    //不传过期时间,查询过期时间
    if ($expire_time === 'no') {
        $info = db_func('users', 'md_')->where('username', $username)->field('expire_time')->find();
        if (!$info) return false;
        $expire_time = intval($info['expire_time']);
    }

    if ($expire_time <= time()) {
        return db_func('users', 'md_')->where('username', $username)->update(['num' => 1, 'pc_num' => 1, 'app_num' => 1, 'plugin_num' => 1]);
    }
    return true;
}

/**
 * 输出xml字符
 * @throws WxPayException
 **/
function to_xml($values)
{
    if (!is_array($values)
        || count($values) <= 0
    ) {
        wrong_return('数组数据异常');
    }

    $xml = "<xml>";
    foreach ($values as $key => $val) {
        if (is_numeric($val)) {
            $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
        } else {
            $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
        }
    }
    $xml .= "</xml>";
    return $xml;

}

/**
 * 将xml 转为 array
 * @param string $xml
 * @throws WxPayException
 */
function from_xml($xml)
{
    wrong_return('xml数据异常');
    //将XML转为array
    //禁止引用外部xml实体
    libxml_disable_entity_loader(true);
    $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    return $values;
}


/**
 * GET 请求
 * @param string $url
 */
function http_get($url)
{
    $oCurl = curl_init();
    if (stripos($url, "https://") !== FALSE) {
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
    }
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if (intval($aStatus["http_code"]) == 200) {
        return $sContent;
    } else {
        return false;
    }
}

/**
 * POST 请求
 * @param string $url
 * @param array $param
 * @param boolean $post_file 是否文件上传
 * @return string content
 */
function http_post($url, $param, $post_file = false)
{
    $oCurl = curl_init();
    if (stripos($url, "https://") !== FALSE) {
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
    }
    if (is_string($param) || $post_file) {
        $strPOST = $param;
    } else {
        $aPOST = array();
        foreach ($param as $key => $val) {
            $aPOST[] = $key . "=" . urlencode($val);
        }
        $strPOST = join("&", $aPOST);
    }
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($oCurl, CURLOPT_POST, true);
    curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if (intval($aStatus["http_code"]) == 200) {

        return $sContent;
    } else {
        return false;
    }
}

function postXmlCurl($url, $xml, $useCert = false, $second = 30)
{
    $ch = curl_init();
    //设置超时
    curl_setopt($ch, CURLOPT_TIMEOUT, $second);


    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
//		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,TRUE);
//		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);//严格校验
    //设置header
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    //要求结果为字符串且输出到屏幕上
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    if ($useCert == true) {
        //设置证书
        //使用证书：cert 与 key 分别属于两个.pem文件
        curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
        curl_setopt($ch, CURLOPT_SSLCERT, '../private/weichat_zhima/apiclient_cert.pem');
        curl_setopt($ch, CURLOPT_SSLKEYTYPE, 'PEM');
        curl_setopt($ch, CURLOPT_SSLKEY, '../private/weichat_zhima/apiclient_key.pem');
    }
    //post提交方式
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    //运行curl
    $data = curl_exec($ch);
    //返回结果
    if ($data) {
        curl_close($ch);
        return $data;
    } else {
        $error = curl_errno($ch);
        curl_close($ch);
        throw new \think\Exception("curl出错，错误码:$error");
    }
}


//专用签名
function md_sign($post)
{
    if (!is_array($post)) return false;
    if (isset($post['sign']))
        unset($post['sign']);
    if (isset($post['SIGN']))
        unset($post['SIGN']);
    $data = paraFilter($post);//删除全部空值
    return md5(json_encode($data) . config('union_sign_key'));
}

//专用签名
function api_md_sign($post)
{
    if (!is_array($post)) return false;
    foreach ($post as $k => $v) {
        $arr = ['sign', 'zm-sign'];
        if (in_array($k, $arr)) unset($post[$k]);
    }
    $data = argSort(paraFilter($post));//删除全部空值后排序
    return md5(arr2get($data) . config('union_sign_key'));
}


//返回计算后的过期时间
function calc_expire_time($vip_time = 0, $s_vip_time = 0)
{
    $vip_time = $vip_time < time() ? time() : $vip_time;
    $s_vip_time = $s_vip_time < time() ? time() : $s_vip_time;

    $last_s_vip_time = ($s_vip_time - time()) <= 0 ? 0 : ($s_vip_time - time());
    if ($s_vip_time > 0) {
        $last_vip_time = $vip_time - $s_vip_time;
        $last_vip_time = $last_vip_time <= 0 ? 0 : $last_vip_time;
    } else {
        $last_vip_time = $vip_time - time();
        $last_vip_time = $last_vip_time <= 0 ? 0 : $last_vip_time;
    }
    //剩余总时长
    $last_time = $last_s_vip_time + $last_vip_time;
    //过期时间
    $expire_time = ($vip_time < $s_vip_time) ? $s_vip_time : $vip_time;

    return [
        'expire_time' => $expire_time,
        'last_time' => $last_time,
        'last_time_format' => rt_auto_sec($last_time),
        'last_vip_time' => $last_vip_time,
        'last_vip_time_format' => rt_auto_sec($last_vip_time),
        'last_s_vip_time' => $last_s_vip_time,
        'last_s_vip_time_format' => rt_auto_sec($last_s_vip_time),
        's_vip_time' => $s_vip_time,
        'vip_time' => $vip_time
    ];
}

//检测是否为微信环境
function is_we_chat()
{
    return (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false);
}

function curl_get_content($url)
{
    // 创建一个新cURL资源
    $ch = curl_init();
    // 设置URL和相应的选项
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    //设置超时时间为3s
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
    // 抓取URL并把它传递给浏览器
    $result = curl_exec($ch);
    //关闭cURL资源，并且释放系统资源
    curl_close($ch);
    return $result;
}

function explode_time($time)
{
    if (is_numeric($time)) {
        $value = array(
            "year" => 0, "month" => 0, "day" => 0, "hour" => 0, "sec" => 0
        );
        if ($time >= 31556926) {
            $value["year"] = floor($time / 31556926);
            $time = ($time % 31556926);
        }
        if ($time >= 2592000) {
            $value["month"] = floor($time / 2592000);
            $time = ($time % 2592000);
        }
        if ($time >= 86400) {
            $value["day"] = floor($time / 86400);
            $time = ($time % 86400);
        }
        if ($time >= 3600) {
            $value["hour"] = floor($time / 3600);
            $time = ($time % 3600);
        }
        if ($time >= 60) {
            $value["sec"] = floor($time / 60);
        }
        Return $value;

    } else {
        return FALSE;
    }
}

function get_time_str($time_arr)
{
    if (is_array($time_arr)) {
        $str = "";
        if (!empty($time_arr['year'])) {
            $str .= $time_arr['year'] . "年";
        }
        if (!empty($time_arr['month'])) {
            $str .= $time_arr['month'] . "月";
        }
        if (!empty($time_arr['day'])) {
            $str .= $time_arr['day'] . "天";
        }
        if (!empty($time_arr['hour'])) {
            $str .= $time_arr['hour'] . "小时";
        }
        if (!empty($time_arr['sec'])) {
            $str .= $time_arr['sec'] . "分钟";
        }

        return $str;

    } else {
        return FALSE;
    }
}

function implode_time($year, $month, $day, $hour, $sec)
{

    $time = intval($year) * 31556926 + intval($month) * 2592000 + intval($day) * 86400 + intval($hour) * 3600 + intval($sec) * 60;

    Return $time;

}

//radius统一加密的
function radius_md5($passwd)
{
    return md5($passwd . config('radius_md5_key'));
}

//获取当前页面的url
function get_now_url()
{
    $pageURL = 'http';
    if (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

function is_mobile_request()
{
    $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
    $mobile_browser = '0';
    if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
        $mobile_browser++;
    if ((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') !== false))
        $mobile_browser++;
    if (isset($_SERVER['HTTP_X_WAP_PROFILE']))
        $mobile_browser++;
    if (isset($_SERVER['HTTP_PROFILE']))
        $mobile_browser++;
    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
    $mobile_agents = array(
        'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
        'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
        'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
        'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
        'newt', 'noki', 'oper', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
        'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
        'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
        'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
        'wapr', 'webc', 'winw', 'winw', 'xda', 'xda-'
    );
    if (in_array($mobile_ua, $mobile_agents))
        $mobile_browser++;
    if (strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
        $mobile_browser++;
    // Pre-final check to reset everything if the user is on Windows
    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
        $mobile_browser = 0;
    // But WP7 is also Windows, with a slightly different characteristic
    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
        $mobile_browser++;
    if ($mobile_browser > 0)
        return true;
    else
        return false;
}
