<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo SOURCE;?>/css/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo SOURCE;?>/js/jquery.min.js"></script>

<!-- formValidator -->
<link type="text/css" rel="stylesheet" href="<?php echo SOURCE;?>/formValidator/style/validatorAuto.css" />
<script src="<?php echo SOURCE;?>/formValidator/formValidator.js" type="text/javascript" charset="UTF-8"></script>
<script src="<?php echo SOURCE;?>/formValidator/formValidatorRegex.js" type="text/javascript" charset="UTF-8"></script>
<script src="<?php echo SOURCE;?>/formValidator/DateTimeMask.js" language="javascript" type="text/javascript" ></script>
<!--<script src="<?php echo SOURCE;?>/formValidator/datepicker/WdatePicker.js" defer="defer" type="text/javascript"></script>-->
<!-- /formValidator -->

<script>
$(document).ready(function()
{
    $.formValidator.initConfig({autotip:true,onerror:function(msg){alert(msg)}});
    $("#username").formValidator({onshow:"请输入用户名",onfocus:"用户名至少4个字符,最多10个字符,英文",oncorrect:"该用户名可以注册"})
                .inputValidator({min:4,max:10,onerror:"你输入的用户名非法,请确认"});
                // .regexValidator({regexp:"username",datatype:"enum",onerror:"用户名格式不正确"});
    $("#password").formValidator({onshow:"请输入密码",onfocus:"密码不能为空",oncorrect:"密码合法"})
                .inputValidator({min:1,empty:{leftempty:false,rightempty:false,emptyerror:"密码两边不能有空符号"},onerror:"密码不能为空,请确认"});
    $("#realname").formValidator({onshow:"请输入真实姓名",onfocus:"用户名至少2-8个中文汉字",oncorrect:"该用户名可以注册"})
                .inputValidator({min:4,max:16,onerror:"你输入的用户名非法,请确认"})
                // .regexValidator({regexp:"chinese",datatype:"enum",onerror:"格式不正确"});
//    $("#cal").focus(function(){WdatePicker({skin:'whyGreen',oncleared:function(){$(this).blur();},onpicked:function(){$(this).blur()}});});

});
</script>

</head>
<body>
<div class="main-wrap">
    <div class="path"><span class="path-icon"></span>当前位置：帐号管理<span> &gt; </span>管理员添加</div>
    <div class="set-wrap">
        <form action="" method="post" name="form1" id="form1" onsubmit="return $.formValidator.pageIsValid('1')">
        <div class="wrap-inner">
            <h4 class="main-title">管理员添加</h4>
            <div class="set-area-int">
                <div class="site-info-a">
                <label>
                    <p>登录名：<span>(添加后登录名不能修改)</span></p>
                    <input name="username" id="username" class="input-box site-box-w" type="text" />
                </label>
                </div>
                <div class="site-info-a">
                <label>
                    <p>密码：<span></span></p>
                    <input name="password" id="password" class="input-box site-box-w" type="text" />
                </label>
                </div>
                <div class="site-info-a">
                <label>
                    <p>管理员组：<span>(要添加的管理员属于哪个管理员组)</span></p>
                    <select name="group_id" id="group_id">
                    <?php foreach($this->groups as $v):?>
                    <option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
                    <?php endforeach;?>
                    </select>
                </label>
                </div>
                <div class="site-info-a">
                <label>
                    <p>真实姓名：<span>(必填)</span></p>
                    <input name="realname" type="text" id="realname"  class="input-box site-box-w" />
                </label>
                </div>
                <div class="site-info-a">
                    <p>性别：<span></span></p>
                    <label><input name="sex" type="radio" value="1" checked="checked" />男</label>&nbsp;&nbsp;
                    <label><input name="sex" type="radio" value="0"  />女</label>
                </div>
                <div class="site-info-b">
                <label>
                    <p>电话：<span></span></p>
                    <input name="telphone" id="telphone" class="input-box site-box-w" type="text" />
                </label>
                </div>
            </div>
        </div>
<!--        <input name="cal" id="cal" class="input-box site-box-w" type="text" />日历控件测试 -->
        <div class="button button-position"><input type="submit" id="submitBtn" name="submit" value="确认添加" /></div>
        </form>

    </div>
</div>

</body>
</html>
