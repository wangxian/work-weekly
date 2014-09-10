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
    // $.formValidator.initConfig({autotip:true,onerror:function(msg){alert(msg)}});
    // $("#title").formValidator({onshow:"请输入标题.",onfocus:"至少6个字符,最多20个字符。",oncorrect:"输入正确."})
    //             .inputValidator({min:6,max:20,onerror:"你输入的用户名非法,请确认."});
    // $("#content").formValidator({onshow:"请输入内容.",onfocus:"至少要输入10个汉字或20个字符",oncorrect:"恭喜你,你输对了",defaultvalue:"内容！"})
    //              .inputValidator({min:20,onerror:"你输入的描述长度不正确,请确认"});

//    $("#cal").focus(function(){WdatePicker({skin:'whyGreen',oncleared:function(){$(this).blur();},onpicked:function(){$(this).blur()}});});

});
</script>

</head>
<body>
<div class="main-wrap">
    <div class="path"><span class="path-icon"></span>当前位置：课程价格<span> &gt; </span>修改</div>
    <div class="set-wrap">
        <form action="" method="post" name="form1" id="form1" onsubmit="return $.formValidator.pageIsValid('1')">
        <div class="wrap-inner">
            <h4 class="main-title">课程价格修改</h4>
            <div class="set-area-int">

                <div class="site-info-a">
                <label>
                    <p>项目名称：<span>(课程项目名称，如：常规单次卡)</span></p>
                    <input name="title" value="<?php echo $this->data["title"];?>" class="input-box site-box-w" type="text" />
                </label>
                </div>

                <div class="site-info-a">
                <label>
                    <p>课时：<span>(例如：20课时)</span></p>
                    <input name="period" value="<?php echo $this->data["period"];?>" class="input-box site-box-w" type="text" />
                </label>
                </div>

                <div class="site-info-a">
                <label>
                    <p>价格：<span>（例如：2400元）</span></p>
                    <input name="price" value="<?php echo $this->data["price"];?>" class="input-box site-box-w" type="text" />
                </label>
                </div>

                <div class="site-info-a">
                <label>
                    <p>有效期：<span>(如：三个月)</span></p>
                    <input name="expires" value="<?php echo $this->data["expires"];?>" class="input-box site-box-w" type="text" />
                </label>
                </div>

                <div class="site-info-b">
                <label>
                    <p>说明：<span></span></p>
                    <textarea name="intro" cols="100" rows="12"><?php echo $this->data["intro"];?></textarea>
                </label>
                </div>

                <!-- <div class="site-info-b">
                <label>
                    <p>内容：<span style="color:#AFAFAF;">(笔记的内容)</span></p>
                    <textarea rows="10" cols="10" class="input-box site-box-area" id="content" name="content"></textarea>
                </label>
                </div> -->
            </div>
        </div>
<!--        <input name="cal" id="cal" class="input-box site-box-w" type="text" />日历控件测试 -->
        <div class="button button-position"><input type="submit" id="submitBtn" name="submit" value="确认修改" /></div>
        </form>

    </div>
</div>

</body>
</html>
