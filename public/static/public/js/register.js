/**
 * 前端注册业务类
 */

var register = {
	check:function(){
		// 获取登录页面中的用户名和密码
		var username = $('input[name="username"]').val();
		var password1 = $('input[name="password1"]').val();
		var password2 = $('input[name="password2"]').val();
		var emil = $('input[name="emil"]').val();

		if(!username){
			return dialog.msg('用户名不能为空！');
		}
		if(!emil){
			return dialog.msg('邮箱不能为空！');
		}
		if(!password1){
			return dialog.msg('密码不能为空！');
		}
		if(!password2){
			return dialog.msg('请再次输入密码！');
		}


		// 执行异步请求	$.post
		var url = '/public/admin/login/register_check';
		var data = {'username':username,'password':password2,'emil':emil};
		$.post(url,data,function(result){
			 if(result.status == 0){
			 	return dialog.msg(result.message)
			 }
			 if(result.status == 1){
			 	return dialog.msg_url(result.message,'/public/admin/index/index')
			 }
		},'JSON');

	},
}