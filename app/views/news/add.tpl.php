<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo SOURCE;?>/css/admin.css" rel="stylesheet" type="text/css" />

<!-- xheditor -->
<script type="text/javascript" src="<?php echo SOURCE;?>/xheditor/jquery/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo SOURCE;?>/xheditor/xheditor-1.1.14-zh-cn.min.js"></script>
<!-- /xheditor -->

<!-- formValidator -->
<link type="text/css" rel="stylesheet" href="<?php echo SOURCE;?>/formValidator/style/validatorAuto.css" />
<script src="<?php echo SOURCE;?>/formValidator/formValidator.js" type="text/javascript" charset="UTF-8"></script>
<script src="<?php echo SOURCE;?>/formValidator/formValidatorRegex.js" type="text/javascript" charset="UTF-8"></script>
<script src="<?php echo SOURCE;?>/formValidator/DateTimeMask.js" language="javascript" type="text/javascript" ></script>
<!-- /formValidator -->

<link href="<?php echo SOURCE;?>/swfupload/default.css" rel="stylesheet" type="text/css" />
<!--<script type="text/javascript" src="<?php echo SOURCE;?>/js/jquery.min.js"></script>-->
<script type="text/javascript" src="<?php echo SOURCE;?>/swfupload/swfupload.js"></script>

</head>
<body>
<div class="main-wrap">

    <div class="path"><span class="path-icon"></span>当前位置: 新闻管理<span> &gt; </span>添加</div>
    <div class="set-wrap">
        <form action="" method="post" name="form1" id="form1" onsubmit="return $.formValidator.pageIsValid('1')">
        <div class="wrap-inner">
            <h4 class="main-title">新闻添加</h4>
            <div class="set-area-int">

                <div class="site-info-a">
                <label>
                    <p>新闻标题：<span>(必须填写)</span></p>
                    <input name="title" id="title" class="input-box site-box-w" type="text" />
                </label>
                </div>

                <div class="site-info-a">
                <label>
                    <p>新闻分类：<span>(可选: 新闻动态 或 活动公告)</span></p>
                    <input name="category" type="hidden" value="news" />
                    <select name="news_type">
                      <option value="1">新闻动态</option>
                      <option value="-1">活动公告</option>
                      <option value="0">二者都是</option>
                    </select>
                </label>
                </div>

                <div class="site-info-a">
                <label>
                  <p>Baner：<span>(通栏大图，尺寸：1240x480（px）, 如果希望不修改，不用重新上传; 无banner则不显示。)</span></p>

                  <div id="upload" style="width: 180px; height: 18px; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px;">
                    <span id="spanButtonPlaceholder"></span>
                  </div>
                  <div id="reupload"></div>
                  <input type="hidden" name="banner" id="uploadpic" value="" />
                  <div id="divFileProgressContainer"></div>
                  <div id="thumbnails"></div>

                </label>
                </div>

                <div class="site-info-a">
                <label>
                  <p>英文摘要：<span></span></p>
                  <textarea name="intro_en" cols="100" rows="12"></textarea>
                </label>
                </div>

                <div class="site-info-a">
                <label>
                  <p>中文摘要：<span></span></p>
                  <textarea name="intro_zh" cols="100" rows="12"></textarea>
                </label>
                </div>

                <div class="site-info-b">
                <label>
                  <p>内容：<span>(文章内容)</span></p>
                  <textarea id="content" class="" name="content" cols="100" rows="20"></textarea>
                </label>
                </div>

            </div>
          </div>
          <div class="button button-position"><input type="submit" name="submit" id="submitBtn" value="确认添加" /></div>


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

<script type="text/javascript" src="<?php echo SOURCE;?>/swfupload/handlers.js"></script>
<script type="text/javascript">

var setting = {
  // Backend Settings
  upload_url: "",
  file_post_name : "filedata",
  post_params: {"PHPSESSID": "<?php echo session_id(); ?>"},

  // File Upload Settings
  file_size_limit : "10 MB",
  file_types : "*.jpg;*.png",
  file_types_description : "JPG Images; PNG Image",
  file_upload_limit : 100,
  file_queue_limit : 0,

  // Event Handler Settings - these functions as defined in Handlers.js
  //  The handlers are not part of SWFUpload but are part of my website and control how
  //  my website reacts to the SWFUpload events.
  swfupload_preload_handler : preLoad,
  swfupload_load_failed_handler : loadFailed,
  file_queue_error_handler : fileQueueError,
  file_dialog_complete_handler : fileDialogComplete,
  upload_progress_handler : uploadProgress,
  upload_error_handler : uploadError,
  upload_success_handler : uploadSuccess,
  upload_complete_handler : uploadComplete,

  // Button Settings
  button_image_url : "<?php echo SOURCE;?>/swfupload/images/SmallSpyGlassWithTransperancy_17x18.png",
  button_placeholder_id : "spanButtonPlaceholder",
  button_width: 180,
  button_height: 18,
  button_text : '<span class="button">选择一个上传文件 <span class="buttonSmall">(2 MB Max)</span></span>',
  button_text_style : '.button { font-family: Helvetica, Arial, sans-serif; font-size: 12pt; } .buttonSmall { font-size: 10pt; }',
  button_text_top_padding: 0,
  button_text_left_padding: 18,
  button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
  button_cursor: SWFUpload.CURSOR.HAND,

  // Flash Settings
  flash_url : "<?php echo SOURCE;?>/swfupload/swfupload.swf",
  flash9_url : "<?php echo SOURCE;?>/swfupload/swfupload_fp9.swf",

  custom_settings : {
    // upload_target : "divFileProgressContainer",
    // thumbnail_width: 1240,
    // thumbnail_height: 480,
    // thumbnail_quality: 100
  },

  // Debug Settings
  debug: false
}

setting.upload_url = "<?php echo U('upload/swfupload');?>";
setting.button_placeholder_id = "spanButtonPlaceholder";
setting.custom_settings = {
  upload_target  : "divFileProgressContainer",
  upload_btnbox  : "upload",
  reupload       : "reupload",
  hidden_input   : "uploadpic",
  thumbnails     : "thumbnails",

  thumbnail_width: 1240,
  thumbnail_height: 480,
  thumbnail_quality: 100
}
var bannerSWU = new SWFUpload(setting);

// setting.upload_url = "<?php echo U('upload/swfupload');?>?square=true&size=75";
// setting.button_placeholder_id = "spanButtonPlaceholder-avatar";
// setting.custom_settings = {
//   upload_target  : "divFileProgressContainer-avatar",
//   upload_btnbox  : "upload-avatar",
//   reupload       : "reupload-avatar",
//   hidden_input   : "uploadpic-avatar",
//   thumbnails     : "thumbnails-avatar",

//   thumbnail_width: 75,
//   thumbnail_height: 75,
//   thumbnail_quality: 100
// }
// var avatarSWU = new SWFUpload(setting);

</script>
</body>
</html>
