<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo SOURCE;?>/css/admin.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="main-wrap">
	<div class="path"><span class="path-icon"></span>当前位置：帐号管理<span> &gt; </span>管理员列表</div>
    <div class="set-wrap">
        <h4 class="main-title">管理员列表</h4>
		<div class="set-area-int">
        	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-border">
                <thead class="td-title-bg">
  					<tr>
    					<td>编号</td>
    					<td>帐号(登录名)</td>
<!--                        <td>真实姓名</td>-->
                        <td>管理员组</td>
                        <td width="160px">最后登录时间</td>
    					<td>登录次数</td>
    					<td>操作</td>
  					</tr>
                </thead>
                <tbody>
                	<?php if($this->all_user):?>
					<?php foreach($this->all_user as $v):?>
					<tr>
						<td><?php echo $v['id'];?></td>
						<td><?php echo $v['username'];?></td>
<!--						<td><?php // echo $v['realname'];?></td>-->
						<td><?php echo $v['group_name'];?></td>
						<td><?php echo $v['lastlogintime']?date('Y-m-d H:i:s', $v['lastlogintime']):'--';?></td>
						<td><?php echo $v['logincount'];?>次</td>
						<td>
							<a class="change-icon" href="<?php echo U('rights/sysuserModi/uid/'.$v['id']);?>">修改</a>
							<a class="del-icon" href="<?php echo U('rights/sysuserDel/uid/'.$v['id']);?>" onclick="javascript:return confirm('你确定要删除吗？');">删除</a>
						</td>
					</tr>
					<?php endforeach;?>
					<?php else:?>
					<tr>
						<td colspan="7" align="center">无内容</td>
					</tr>
					<?php endif;?>
                </tbody>
			</table>
    	</div>
    </div>
</div>
</body>
</html>
