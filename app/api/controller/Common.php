<?php
namespace app\api\controller;

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
        $this->page = (int)input('param.page', '1');
        $this->page_num = 20;
    }

    private function chk_login()
    {
        if (IS_CLI) {
            return true;
        }

        $allow_list = [
            'api/account/index',
            'api/account/login_do'
        ];
        $request = \think\Request::instance();
        $path = strtolower($request->module() . '/' . $request->controller() . '/' . $request->action());

        if (in_array($path, $allow_list)) {
            return true;
        }

        if (!is_user_login()) {
            $this->redirect(url('api/account/index'));
        }else{
            $user_info = db('users')->where(['id'=>get_user_id(),'status'=>1])->find();
            if(!$user_info){
                session('user',null);
                $this->redirect(url('api/account/index'));
            }
        }
        return true;
    }

}