<?php
namespace app\lib;

use app\core\model\AuthModel;
use app\core\model\CommonModel;
use app\lib\tb_sdk\top\TopClient;
use app\lib\tb_sdk\top\request;
use think\Exception;
Class PhoneCode
{
    public function __construct()
    {

    }

    public function alidayu_send_obj($phone,$tpl,$data){
        $top = new TopClient();
        $top->appkey = config('CONF_ALIDAYU_APP_KEY');
        $top->secretKey = config('CONF_ALIDAYU_SECRET');
        $req = new request\AlibabaAliqinFcSmsNumSendRequest();
        $req->setExtend("654321");
        $req->setSmsType("normal");
        $req->setSmsFreeSignName(config('CONF_ALIDAYU_SIGN'));
        $param = json_encode($data);
        $req->setSmsParam($param);
        $req->setRecNum($phone);
        $req->setSmsTemplateCode($tpl);
        $obj = $top->execute($req);
        return obj_to_arr($obj);
    }

    //螺丝帽短信发送接口    $flag=true时允许发送,重试的时候防止多发
    public function send_sms_luosimao($mobile, $phone_code, $plat_name = '梦蝶')
    {
        if (empty($mobile) || empty($phone_code)) return false;
//        $m_com = new CommonModel();
        $luosi_key = Config('LUOSIMAO_KEY');
        $content = "验证码:" . $phone_code . "【" . $plat_name . "】";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://sms-api.luosimao.com/v1/send.json");
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, 'api:key-' . $luosi_key);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $mobile, 'message' => $content));

        $res = curl_exec($ch);
        curl_close($ch);
        //file_put_contents("sms.txt", "luosimao send success ! " . $mobile . " : " . $res, FILE_APPEND);
        $json = json_decode($res, true);
        $json['plat'] = 'luosimao';
        return $json;
    }

    //获奖螺丝帽发送短信
    public function luosimao_win($mobile, $nper_id)
    {
        if (empty($mobile) || empty($phone_code)) return false;
//        $base_model = new CommonModel();
//        $web_name = $base_model->get_conf("WEBSITE_NAME");
//        $plat_name = $base_model->get_conf("LUOSIMAO_SIGN");

        $luosi_key = Config('LUOSIMAO_KEY');
        $content = "恭喜您在第" . $nper_id . "期中获奖,请登录" . $web_name . "官网查看【" . $plat_name . "】";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://sms-api.luosimao.com/v1/send.json");
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, 'api:key-' . $luosi_key);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $mobile, 'message' => $content));

        $res = curl_exec($ch);
        curl_close($ch);
        //file_put_contents("sms.txt", "luosimao send success ! " . $mobile . " : " . $res, FILE_APPEND);
        $json = json_decode($res, true);
        $json['plat'] = 'luosimao';
        return $json;
    }

    //阿里大鱼发短信接口
    public function alidayu_reg_sms($phone, $phone_code, $product = '梦蝶')
    {
        $top = new TopClient();

        $appkey = config('CONF_ALIDAYU_APP_KEY');
        $secret = config('CONF_ALIDAYU_SECRET');
        $ali_tmp = config('CONF_ALIDAYU_TPL');
        $product = config('CONF_ALIDAYU_SIGN');

        if (empty($ali_tmp)) return false;

        $top->appkey = $appkey;
        $top->secretKey = $secret;
        $req = new request\AlibabaAliqinFcSmsNumSendRequest();
        $req->setExtend("654321");
        $req->setSmsType("normal");
        $req->setSmsFreeSignName(config('CONF_ALIDAYU_SIGN'));
        $param = '{"code":"' . $phone_code . '","product":"' . $product . '"}';
        $req->setSmsParam($param);
        $req->setRecNum($phone);
        $req->setSmsTemplateCode($ali_tmp);
        $obj = $top->execute($req);

        return obj_to_arr($obj);
    }

    //阿里大鱼语音通知接口
    public function alidayu_vn($phone)
    {
        $top = new TopClient();
//        $m_com = new CommonModel();

//        $appkey = $m_com->get_conf("ALIDAYU_KEY");
//        $secret = $m_com->get_conf("ALIDAYU_SECRET");
//        $show_num = $m_com->get_conf("被叫号显");//被叫号显，传入的显示号码必须是阿里大鱼“管理中心-号码管理”中申请通过的号码
//        $voice_code = $m_com->get_conf("语音文件ID");//语音文件ID，传入的语音文件必须是在阿里大鱼“管理中心-语音文件管理”中的可用语音文件

        if (empty($show_num) || empty($voice_code)) return false;

        $top->appkey = $appkey;
        $top->secretKey = $secret;
        $req = new AlibabaAliqinFcVoiceNumSinglecallRequest;
        $req->setExtend("12345");
        $req->setCalledNum($phone);
        $req->setCalledShowNum($show_num);
        $req->setVoiceCode($voice_code);
        $obj = $top->execute($req);
        return obj_to_arr($obj);
    }

    //身份验证验证码
    public function alidayu_forgot_sms($phone, $phone_code, $product = '香肠购')
    {
        $top = new TopClient();
        $m_com = new CommonModel();

//        $appkey = $m_com->get_conf("ALIDAYU_KEY");
//        $secret = $m_com->get_conf("ALIDAYU_SECRET");
//        $ali_tmp = $m_com->get_conf("MSG_AUTH_ALIDAYU");
        $product = empty(Config('SMS_TEMP_NAME')) ? $product : C('SMS_TEMP_NAME');
        if (empty($ali_tmp)) return false;

        $top->appkey = $appkey;
        $top->secretKey = $secret;
        $req = new request\AlibabaAliqinFcSmsNumSendRequest();
        $req->setExtend("654321");
        $req->setSmsType("normal");
        $req->setSmsFreeSignName("注册验证");
        $param = '{"code":"' . $phone_code . '","product":"' . $product . '"}';
        $req->setSmsParam($param);
        $req->setRecNum($phone);
        $req->setSmsTemplateCode($ali_tmp);
        $obj = $top->execute($req);
        return obj_to_arr($obj);
    }
}