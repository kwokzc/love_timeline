<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Login extends Model
{
  // 用于注册
  public function register($data)
  {
    // 密码md5加密
    $data['password'] = md5($data['password']);
    // 检查数据库username是否已经存在，存在直接return
    // 为空说明username不存在，可以注册
    if (empty(Db::name('user')->where('username',$data['username'])->find())) {
      $res = Db::name('user')->insert($data);
      return $res;
    }else{
      return show(0,'用户名已存在！');
    }
  }

  // 用于登录
  public function login($username)
  {
    // 通过username获取数据库结果return
    $res = Db::name('user')->where('username',$username)->find();
    return $res;
  }
}
