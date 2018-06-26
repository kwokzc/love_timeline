<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use app\admin\model\Login as LoginModel;
class Login extends Controller
{
    // 登录业务

    // 输出登录界面前台页面
    public function index()
    {
        // 如果已经登录过，进入登录页面自动跳转到后台
        if (Session::get('username')) {
            $this->redirect('admin/index/index');
        }else{
            return view();
        }
    }
    // 登录效验
    public function login_check()
    {
        // 检查用户名密码是否为空
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        if (!trim($username)) {
            return show(0,'用户名不能为空！');
        }
        if (!trim($password)) {
            return show(0,'密码不能为空！');
        }

        // 连接数据库
        $DB = new LoginModel;
        $res = $DB->login($username);

        // $res为空时说明用户名不存在
        if (empty($res)) {
            return show(0,'用户名不存在！');
        }
        // 检验密码
        if ($password==$res['password']) {
            Session::set('username',$username);
            return show(1,'登录成功！');
        }else{
            return show(0,'密码错误！');
        }
    }
    public function login_logout(){
        $username = $_POST['username'];
        Session::set('username',null);
        return show(1,'退出成功！');
    }

    // 注册业务

    // 输出注册界面前台页面
    public function register()
    {
        return view();
    }

    // 注册检查
    public function register_check()
    {
        // 获取POST传递值
        $username = $_POST['username'];
        $password = $_POST['password'];
        $emil = $_POST['emil'];

        // 检验用户名密码邮箱
        if (!trim($username)) {
            return show(0,'用户名不能为空！');
        }
        if (!trim($password)) {
            return show(0,'密码不能为空！');
        }
        if (!trim($emil)) {
            return show(0,'邮箱不能为空！');
        }else{
            // 检验邮箱规则合法性
            $pattern="/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/";
            if (!preg_match($pattern, $emil)) {
                return show(0,'邮箱格式不正确！');
            }
        }

        // 组成数组 后续传递给Model
        $data = array(
            'username' => $username, 
            'password' => $password, 
            'emil' => $emil, 
            );
        // 连接数据库
        $DB = new LoginModel;
        $res = $DB->register($data);

        // 成功返回1 数据库写入成功
        // 用户名不能重复,此效验在Model层处理
        if ($res) {
            Session::set('username',$username);
            return show(1,'注册成功！');
        }else{
            return show(0,'注册失败！');
        }
    }

    // 找回密码业务
    public function forgot_password()
    {
        return view();
    }
}
