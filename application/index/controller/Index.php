<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Index as IndexModel;
class Index extends Controller
{
    public function index()
    {
    	$index = new IndexModel;
    	$res = $index->showindex();
    	// print_r($res);die;
    	// dump($res);die;
    	$this->assign('list',$res);
        return view();
    }
}
