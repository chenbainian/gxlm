<?php
function is_user_login(){
    $user_info = session('user');
    if(!$user_info){
        return false;
    }
    return true;
}

function get_user_info(){
	$user_info = session('user');
    if(!$user_info){
        return false;
    }
    return $user_info;
}

function get_user_name(){
    $user_name = session('user.username');
    return $user_name;
}

function get_nick_name(){
    $user_name = session('user.nick_name');
    return $user_name;
}

function get_user_id(){
    $user_id = session('user.id');
    return $user_id;
}

function preg_page($page){
    $page = str_replace('pagination','am-pagination am-pagination-right',$page);
    $page = str_replace('disabled','am-disabled',$page);
    $page = str_replace('active','am-active',$page);
    return $page;
}

