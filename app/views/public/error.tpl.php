<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>操作失败</title>
<?php if ($url):?>
<meta http-equiv='refresh' content='<?php echo $wait;?>;URL=<?php echo $url;?>'>
<?php endif;?>
<link href="<?php echo SOURCE;?>/css/admin.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
	<div class="tips_box">
		<div class="tips_c">
			<div class="tips_r">
				<h3 class="error"><?php echo $message;?></h3>
				<?php if ($url): ?>
				<p><a href="<?php echo $url;?>">该页面将于<?php echo $wait;?>秒后中转,如果你的浏览器不支持自动跳转,请点击这里</a></p>
				<?php endif;?>
			</div>
		</div>
	</div>
</div>
</body>
</html>
