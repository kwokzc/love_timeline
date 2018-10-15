<?php
namespace app\admin\controller;
use think\Controller;
use think\View;
use think\Session;
use app\admin\model\Index as IndexModel;
class Index extends Controller
{
    public function index()
    {
    	if (empty(Session::get('username'))) {
    		$this->error('当前未登录！','public/admin/login/index');
    	}
    	$view = new view();
    	$DB = new IndexModel();
    	$view->username = Session::get('username');
    	$view->love_day = day_interval(config('config.love_day'),time());
    	$view->timeline_num = $DB->timeline_num();
    	// $view->love_day = day_interval('config.love_day',time());
        return $view->fetch();
    }
    public function table()
    {
        $view = new view();
        $view->username = Session::get('username');
        
        return $view->fetch();
    }
    public function form()
    {
        $view = new view();
        $view->username = Session::get('username');
        
        return $view->fetch();
    }
}
