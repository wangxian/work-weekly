<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html id="index" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理中心</title>
<link href="<?php echo SOURCE;?>/css/admin.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?php echo SOURCE;?>/favicon.ico" />
<script type="text/javascript" src="<?php echo SOURCE;?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SOURCE;?>/js/admin.js"></script>
<script>
$(function(){
	admin.index.init();
});
</script>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div class="logo"></div>
		<div class="menu">
        <?php
        if( !empty($this->menu1) ):
        foreach ($this->menu1 as $k=>$v):
        	if(empty($_SESSION['rights'][$k])) continue; //不显示无权限的菜单
           	echo '<a href="#" class="item_menu">'. $v .'</a>';
        endforeach;
        endif;
        ?>
        </div>
		<div class="log-info">
        	<span>欢迎回来：<a target="mainframe" href="/index.php/staff/edit/id/<?php echo Session::get("sysuser.user_id");?>.html?from=top"><?php echo Session::get('sysuser.realname');?></a></span>
            <em>|</em>
            <a href="<?php echo U('index/logout');?>">退出系统</a>
            <em>|</em>
            <a href="javascript:void(0)" onclick="javascript:parent.mainframe.location.reload();">刷新主窗口</a>
            <a class="back-home" href="" target="_blank">返回首页</a>
        </div>
	</div>
	<div id="container">
	  <div class="sidebar">
	  		<?php
	  		if( !empty($this->menu2) ): foreach ($this->menu2 as $k=>$v):

	  		if(empty($_SESSION['rights'][$k])) continue; //不显示无权限的菜单

	  		echo '<div class="sub-menu">';

	  			$k=1;
	  			foreach ($v as $k2=>$v2):
	  				//是否第一个菜单
	  				if($k==1):
	  					echo '<h3 class="sidebar-title-top">'. $k2 .'</h3>';
	  				else:
	  					echo '<h3 class="sub-menu-titleline">'. $k2 .'</h3>';
	  				endif;

	  				echo '<div class="sub-menu-info">';

	  				foreach ($v2 as $k3=>$v3):
	  					//验证权限，确定是否显示该菜单
	  					list($controller,$action) = explode('/',$k3);
	  					if(empty($_SESSION['rights'][$controller]) || !in_array($action, $_SESSION['rights'][$controller]))
	  						continue;
	  					echo '<a href="', U($k3) ,'" target="mainframe">', $v3 ,'</a>';
	  				endforeach;

	  				echo '</div>';
	  				$k++;
	  			endforeach;

	  		echo '</div>';
	  		endforeach; endif;
	  		?>
		</div>
		<div class="main">
            <iframe id="mainframe" width="100%" name="mainframe" frameborder="0" src="javascript:void(0);"  scrolling="yes"></iframe>
		</div>
	</div>
</div>

</body>
</html>
