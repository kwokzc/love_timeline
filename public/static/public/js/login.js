/**
 * 前端登录业务类
 */

var login = {
	check:function(){
		// 获取登录页面中的用户名和密码
		var username = $('input[name="username"]').val();
		var password = $('input[name="password"]').val();

		if(!username){
			dialog.msg('用户名不能为空！');
			return;
		}
		if(!password){
			dialog.msg('密码不能为空！');
			return;
		}

		// 执行异步请求	$.post
		var url = '/public/admin/login/login_check';
		var data = {'username':username,'password':password};
		$.post(url,data,function(result){
			 if(result.status == 0){
			 	return dialog.msg(result.message)
			 }
			 if(result.status == 1){
			 	return dialog.msg_url(result.message,'/public/admin/index/index')
			 }
		},'JSON');

	},
	logout:function(){
		var username = document.getElementById("username").innerText;
		var url = '/public/admin/login/login_logout';
		var data = {'username':username};
		$.post(url,data,function(result){
			if (result.status == 1) {
				return dialog.msg_url(result.message,'/public/admin/login/index')
			}
		},'JSON');
	}
}