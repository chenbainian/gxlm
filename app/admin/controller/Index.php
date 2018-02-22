<?php
namespace app\admin\controller;

use think\Controller;

Class Index extends Common
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        return $this->fetch('index');
    }

    public function desktop(){
        return $this->fetch('desktop');
    }

}