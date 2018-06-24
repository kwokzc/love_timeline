<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>添加新内容</title>
    <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet" />
    <link type="text/css" href="css/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
    <link type="text/css" href="css/jquery-ui-timepicker-addon.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="js/jquery-ui-timepicker-zh-CN.js"></script>
    <script type="text/javascript">
    $(function () {
        $(".ui_timepicker").datetimepicker({
            //showOn: "button",
            //buttonImage: "./css/images/icon_calendar.gif",
            //buttonImageOnly: true,
            showSecond: true,
            timeFormat: 'hh:mm:ss',
            stepHour: 1,
            stepMinute: 1,
            stepSecond: 1
        })
    })
    </script>

    <script type="text/javascript">
window.onload = function(){
    var a = document.getElementById("timeinput");
    var b = document.getElementById("titleinput");
    var c = document.getElementById("textinput");
    var d = document.getElementById("timemarkinput");
    var e = document.getElementById("authorinput");
    var f = document.getElementById("lookinput");
    var jc = document.getElementById("btn");
    jc.onclick = function(event){
        var a1 = a.value;
        var b1 = b.value;
        var c1 = c.value;
        var d1 = d.value;
        var e1 = e.value;
        var f1 = f.value;
        if(a1==""){
            alert("未选择时间");
            return false;
        }else if(b1==""){
            alert("未写入标题");
            return false;
        }else if(c1==""){
            alert("未写入内文");
            return false;
        }else if((d1!="1")&&(d1!="2")){
            alert("未正确写入时间标记，请填写1或2");
            return false;
        }else if(e1!="1"&&e1!="2"){
            alert("未正确写入底色标记，请填写1或2");
            return false;
        }else if(f1!="1"&&f1!="0"){
            alert("未正确写入隐私标记，请填写1或0");
            return false;
        }
    }
     
}
    </script>
</head>
<body style="text-align:center">
<?php
    if (!empty($_POST['datetime'])) {
        //include 'demo.php';
        $mysql_server_name='localhost'; //改成自己的mysql数据库服务器
        $mysql_username='tl_mylover_ml'; //改成自己的mysql数据库用户名
        $mysql_database='tl_mylover_ml'; //改成自己的mysql数据库名
        $mysql_password='PH8kA4Grxh'; //改成自己的mysql数据库密码
        $mysql_table='timeline';
        //echo $_POST['title']."<br>结束";
        //echo $_POST['datetime'].$_POST['type'].$_POST['title'].$_POST['text'].$_POST['location'].$_POST['timemark'].$_POST['author'].$_POST['look']."<br>";
        $location=$_POST['location'];
        if ($location=="") {
            $location="none";
        }
        $conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("Unable to connect //to the MySQL!") ; //连接数据库
        mysql_query("set names 'utf8'"); //数据库输出编码 应该与数据库编码保持一致 建议用UTF-8 国际标准编码.
        mysql_select_db($mysql_database,$conn); //打开数据库

        $text_br=str_replace("\n", "<br>", $_POST['text']);
        $text_br=str_replace("'", "\'", $text_br);
        $title_zhuanyi=str_replace("'", "\'", $_POST['title']);

        $sql ="INSERT INTO `timeline` (`id`, `time`, `type`, `title`, `text`, `location`, `timemark`, `author`, `look`) VALUES (NULL, '{$_POST['datetime']}', '{$_POST['type']}', '{$title_zhuanyi}', '{$text_br}', '{$location}', '{$_POST['timemark']}', '{$_POST['author']}', '{$_POST['look']}');"; //SQL语句
        //echo "<br>".$sql."<br>sql输出完毕<br>";
        if (mysql_query($sql)) {
            echo "<script type='text/javascript'>alert('写入成功!');</script>";
        }else{
            echo $sql."<br>";
            $logfile  = 'log.txt';
            if($f  = file_put_contents($logfile, $sql."\n",FILE_APPEND)){// 这个函数支持版本(PHP 5) 
                echo "log记录成功,请不要担心<br>";
            }
            echo "<script type='text/javascript'>alert('写入失败!');</script>";
        }
        mysql_close();
        }
    
?>
<div class="container"  >
    <form class="form-signin"  method="post">
        <h2 class="form-signin-heading;" style="text-align:left;">时间:</h2>
        <input id="timeinput" type="text" name="datetime" class="ui_timepicker form-control" placeholder="点击选择时间" required="required" readOnly="readOnly">
        <h2 class="form-signin-heading;" style="text-align:left;">类型:</h2>
        <select name="type" class="form-control">
                <option value="text">文字</option>
                <option value="mood">心情</option>
                <option value="picture">图片</option>
                <option value="movie">电影</option>
        </select>
        <h2 class="form-signin-heading;" style="text-align:left;">标题:</h2>
        <input id="titleinput" type="text" name="title" class="form-control" placeholder="输入标题" required="required">
        <h2 class="form-signin-heading;" style="text-align:left;">内文:</h2>
        <textarea id="textinput" name="text" class="form-control" cols="30" rows="10" required="required"></textarea>
        <h2 class="form-signin-heading;" style="text-align:left;">地点:</h2>
        <input id="titleinput" type="text" name="location" class="form-control" placeholder="输入标题" required="required">
        <h2 class="form-signin-heading;" style="text-align:left;">时间显示:</h2>
        <select name="timemark" class="form-control">
                <option value="1">年月日</option>
                <option value="2">年月日时分秒</option>
        </select>
        <!--<input id="timemarkinput" type="text" name="timemark" class="form-control" placeholder="1显示年月日，2显示年月日时分秒" required="required" value="1">-->
        <h2 class="form-signin-heading;" style="text-align:left;">底色显示:</h2>
        <select name="author" class="form-control">
                <option value="1">蓝色</option>
                <option value="2">红色</option>
        </select>
        <!--<input id="authorinput" type="text" name="author" class="form-control" placeholder="1为蓝色，2为红色" required="required" value="1">-->
        <h2 class="form-signin-heading;" style="text-align:left;">查看权限:</h2>
        <select name="look" class="form-control">
                <option value="1">公开</option>
                <option value="0">隐私</option>
        </select>
        <!--<input id="lookinput" type="text" name="look" class="form-control" placeholder="1为公开，0为隐私" required="required" value="1">-->
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" id="btn">提交记录</button>
        <a class="btn btn-lg btn-success btn-block" href="http://tl.wjdr.net" target="_blank">查看网站</a>
    </form>
</div>
</body>
</html>