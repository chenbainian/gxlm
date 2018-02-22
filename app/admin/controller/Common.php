<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;

Class Common extends Controller
{
    public $page;
    public $page_num;
    public $del_model;
    public $request = '';

    public function __construct()
    {
        parent::__construct();
        $this->chk_login();
        //第几页
        $this->page = (int)input('param.page', '1');
        $this->page_num = 20;//每页显示条数
    }

    //检测是否登录
    private function chk_login()
    {
        //CLI模式下绕过
        if (IS_CLI) {
            return true;
        }

        //允许免检登录的地方
        $allow_list = [
            'admin/account/index',
            'admin/account/login_do'
        ];
        $request = \think\Request::instance();
        $path = strtolower($request->module() . '/' . $request->controller() . '/' . $request->action());

        if (in_array($path, $allow_list)) {
            return true;
        }

        if (!is_admin_login()) {
            $this->redirect(url('admin/account/index'));
        }
        return true;
    }

}