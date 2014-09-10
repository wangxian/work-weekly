<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员登录</title>
<link href="<?php echo SOURCE;?>/css/admin.css" rel="stylesheet" type="text/css" />
<style type="text/css">
html{ background:#F2F5F8;}
</style>
<script type='text/javascript' src='<?php echo SOURCE;?>/js/jquery.min.js'></script>
<script type='text/javascript' src='<?php echo SOURCE;?>/js/admin.js'></script>

<link rel="shortcut icon" href="/favicon.ico">
<script type="text/javascript">
//function refreshCc() {
//	var ccImg = document.getElementById("checkCodeImg");
//	if (ccImg) {
//		ccImg.src= ccImg.src + '&' +Math.random();
//	}
//}
$(function() {
	$('input[type="text"],textarea,input[type="password"]').blur(function() {
		checkForm(this);
	});
	$('#username').focus();
});
function ajax_submit()
{
	$('#username_msg').html('').removeClass("a-error");
	$('#password_msg').html('').removeClass("a-error");
	
	if (! $('#username').val() )
	{
		$('#username_msg').html('用户不能为空！').addClass("a-error").show();
		return false;
	}

	if (! $('#password').val() )
	{
		$('#password_msg').html('密码不能为空！').addClass("a-error").show();
		return false;
	}

	var url = '<?php echo U('index/login');?>';
	var data = {
		'username': $('#username').val(),
		'password': $('#password').val()
	};

	$.post(url, data, function(json){
		//json = eval('(' + json + ')');
		
		if (json.state == '200') {
			window.location.href = '<?php echo U('index/index');?>';
		}
		else if (json.state == '1021') {
			$('#username_msg').html(json.msg).addClass("a-error").show();
		}
		else if (json.state == '1022') {
			$('#password_msg').html(json.msg).addClass("a-error").show();
		}
	},'json')
}

//if(window.self!=window.top) window.open(window.location,'_top');
</script>
</head>
<body>
<div id="login-wrap">
	<div class="login-main">
    	<div class="login-t">
        	<div class="admin-logo"></div>
            <div class="tit"></div>
        </div>
        <div class="login-m">
        	<form id="loginFrm" action="" method="post" onsubmit="ajax_submit();return false;">
            	
                <div class="account1">
                	<label for="username">用户名：</label>
                    <input class="input-box admin-txt" id="username" name="password" type="text" />
                    <span id="username_msg"><?php echo empty($this->username_msg)?'':$this->username_msg;?></span>
                </div>
                <div class="account2">
                	<label for="password">密码：</label>
                    <input class="input-box admin-txt" id="password" name="password" type="password" />
                    <span id="password_msg"><?php echo empty($this->password_msg)?'':$this->password_msg;?></span>
                </div>
                <input class="admin-btn" onfocus="this.blur()" name="" type="submit" value="登 录" />
            </form>
        </div>
    </div>
</div>
</body>
</html>