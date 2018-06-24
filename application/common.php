<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 公共函数
 */

// 用于PHP返回给JS数据的函数，注意需要JSON解码
function show($status,$message,$data=array()){
	$result = array(
		'status' => $status,
		'message' => $message,
		'data' => $data,
		);
	exit(json_encode($result));
}

/**
 * [day_interval 用于计算日期间隔]
 * @param  [时间] $date1 [第一个时间,小时间]
 * @param  [时间] $date2 [第二个时间,大时间,默认为当前时间]
 * @return [整数]        [返回相差的天数]
 */
function day_interval($date1,$date2){
	$cnt=$date2-strtotime($date1);//与已知时间的差值  
	$days = floor($cnt/(3600*24));//算出天数
	return $days;
}