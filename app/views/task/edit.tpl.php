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
<!-- /formValidator -->

</head>
<body>
<div class="main-wrap">

    <div class="path"><span class="path-icon"></span>当前位置: 任务管理<span> &gt; </span>编辑</div>
    <div class="set-wrap">
        <form action="" method="post" name="form1" id="form1" onsubmit="return $.formValidator.pageIsValid('1')">
        <div class="wrap-inner">
            <h4 class="main-title">任务编辑</h4>
            <div class="set-area-int">

                <div class="site-info-a">
                <label>
                    <p>任务名称：<span>(必须填写)</span></p>
                    <input name="title" value="<?php echo $this->data["title"];?>" id="title" class="input-box site-box-w" type="text" />
                </label>
                </div>

                <div class="site-info-a">

                    <p>分配给：<span>（任务分配给谁？）</span></p>
                    <?php $c = count($this->owner); foreach($this->owner as $v):?>
                    <label>
                      <input <?php echo in_array($v["id"], $this->yet_users)?"checked":"";?> type="checkbox" name="staffs[<?php echo $v["id"];?>]" value="<?php echo $v["username"];?>" <?php if($c==1) echo "disabled checked";?> />
                      <?php echo $v["username"];?>
                    </label>&nbsp;&nbsp;
                    <?php endforeach;?>

                </div>

                <div class="site-info-a">
                <label>
                    <p>任务进度：<span>（请选择当前任务的进度）</span></p>
                    <select name="process" id="process">
                      <option value="0">0%</option>
                      <option value="10">10%</option>
                      <option value="20">20%</option>
                      <option value="30">30%</option>
                      <option value="40">40%</option>
                      <option value="50">50%</option>
                      <option value="60">60%</option>
                      <option value="70">70%</option>
                      <option value="80">80%</option>
                      <option value="90">90%</option>
                      <option value="100">100%</option>
                    </select>
                    <script>$(function(){ $("#process").val(<?php echo $this->data["process"];?>); });</script>
                </label>
                </div>

                <div class="site-info-b">
                <label>
                  <p>任务表述：<span>(关于该任务的详细描述，可为空。)</span></p>
                  <textarea id="content" class="" name="content" cols="100" rows="16"><?php echo $this->data["content"];?></textarea>
                </label>
                </div>

            </div>
          </div>
          <div class="button button-position"><input type="submit" name="submit" id="submitBtn" value="确认修改" /></div>


        </form>

    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){

  $.formValidator.initConfig({autotip:true,onerror:function(msg){alert(msg)}});
  $("#title").formValidator({
    onshow:"请输入标题",
    onfocus:"最短4个英文，或2个中文",
    oncorrect:"输入正确!"
  }).inputValidator({
    min:4,
    onerror:"输入的标题验证未通过,请检查！"
  });

  // $("#summary").formValidator({onshow:"请输入摘要",onfocus:"至少10个字，最多120个字，英文占半个字",oncorrect:"输入正确!"})
  //     .inputValidator({min:20,max:240, onerror:"输入无效！"});

  $('#content').xheditor({
    tools:'Pastetext,Blocktag,FontColor,Link,Unlink,Align,|,SelectAll,Table,Hr,Outdent,Indent,Img,Preview,Source,Fullscreen',
    forcePtag:false,
    internalStyle:true,
    inlineStyle:false,
    cleanPaste:2,
    urlType:'abs',upImgUrl:'<?php echo U("upload/img");?>?w=800&h=600'
  });
});
</script>

</body>
</html>
