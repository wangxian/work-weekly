<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo SOURCE;?>/css/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo SOURCE;?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SOURCE;?>/xheditor-1.1.13/xheditor-1.1.13-zh-cn.min.js"></script>


<!-- formValidator -->
<link type="text/css" rel="stylesheet" href="<?php echo SOURCE;?>/formValidator/style/validatorAuto.css" />
<script src="<?php echo SOURCE;?>/formValidator/formValidator.js" type="text/javascript" charset="UTF-8"></script>
<script src="<?php echo SOURCE;?>/formValidator/formValidatorRegex.js" type="text/javascript" charset="UTF-8"></script>
<script src="<?php echo SOURCE;?>/formValidator/DateTimeMask.js" language="javascript" type="text/javascript" ></script>
<!-- /formValidator -->

</head>
<body>
<div class="main-wrap">
  <div class="path"><span class="path-icon"></span>当前位置：文章管理<span> &gt; </span>文章添加</div>
    <div class="set-wrap">
      <form action="" method="post" name="form1" id="form1" onsubmit="return $.formValidator.pageIsValid('1')" enctype="multipart/form-data">
        <div class="wrap-inner">
          <h4 class="main-title">文章添加</h4>
        <div class="set-area-int">

              <div class="site-info-a">
              <label>
                <p>标题：<span>(文章标题)</span></p>
                <input name="title" id="title" class="input-box site-box-w" type="text" />
              </label>
              </div>

                <div class="site-info-a">
                <p>所属主题站：<span></span></p>
                    <select name="site_id">
                      <?php foreach ($this->site as $v):?>
                      <option value="<?php echo $v['id'].'|'.$v['title'];?>"><?php echo $v['title']; ?></option>
                      <?php endforeach;?>
                    </select>
              </div>

                <div class="site-info-a">
                <p>标签：<span>(Tags, 展示在文章的底部，多个标签以 | 隔开.)</span></p>
                    <input name="tags" id="tags" class="input-box site-box-w" type="text" />
              </div>

                <div class="site-info-a">
                <p>作者：<span>(文章的作者.)</span></p>
                    <input name="author" id="author" class="input-box site-box-w" type="text" />
              </div>

                <div class="site-info-a">
              <label>
                <p>背景图：<span>(作为网站文章的背景图，尺寸：460x260)</span></p>
                    <input type="file" name="file" />
              </label>
              </div>

                <div class="site-info-a">
              <label>
                <p>摘要：<span>(展示在首页，主题页，我的首页的文章摘要。)</span></p>
                    <textarea id="summary" class="" name="summary" cols="60" rows="8"></textarea>
              </label>
              </div>

                <div class="site-info-b">
              <label>
                <p>内容：<span>(文字内容)</span></p>
                    <textarea id="content" class="" name="content" cols="100" rows="10"></textarea>
              </label>
              </div>

          </div>
        </div>
        <div class="button button-position"><input type="submit" id="submitBtn" name="submit" value="确认添加" /></div>
    </form>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

  $.formValidator.initConfig({autotip:true,onerror:function(msg){alert(msg)}});
  $("#title").formValidator({onshow:"请输入标题.",onfocus:"至少6个字符。",oncorrect:"输入正确!"})
        .inputValidator({min:6,onerror:"输入的标题非法,请确认"});

  $("#summary").formValidator({onshow:"请输入摘要",onfocus:"至少10个字，最多120个字，英文占半个字",oncorrect:"输入正确!"})
      .inputValidator({min:20,max:240, onerror:"输入无效！"});

  $('#content').xheditor({skin:'nostyle',width:'400',height:'300',html5Upload:true,upImgUrl:'/admin/index.php/upload/img'});

});
</script>

</body>
</html>