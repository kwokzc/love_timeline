<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Index extends Model
{
    public function showindex()
    {
    	$res = Db::name('timeline')->order('time DESC')->paginate(10)->each(function($item,$key){
    		if ($item['look']!=1) {
   				unset($item);
   			}
   			if ($item['timemark']==1) {
   				$item['time'] = date('Y-m-d',strtotime($item['time']));
   			}
   			return $item;
    	});
		return $res;
    }
    public function timeline_num(){
      $res = Db::name('timeline')->count();
      return $res;
    }
}
