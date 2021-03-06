<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo SOURCE;?>/css/admin.css" rel="stylesheet" type="text/css" />
<style>
.finished,.table-border tbody tr.finished:hover {
  background-color: #DFF0D8;
  text-decoration: line-through;
  color: #3C763D;
}
</style>
</head>
<body>
<div class="main-wrap">
    <div class="path"><span class="path-icon"></span>当前位置：任务管理<span> &gt; </span>任务列表</div>
    <div class="set-wrap">
        <h4 class="main-title">我的本周任务列表</h4>
        <div class="set-area-int">

            <div class="user-list">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-border">
                    <thead class="td-title-bg">
                          <tr>
                            <td width="60px">编号</td>
                            <td width="300px">标题</td>
                            <td width="40px">进度</td>
                            <td width="60px">任务归属</td>
                            <td width="100px">更新时间</td>
                            <td width="40px">操作</td>
                          </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($this->data)):?>
                        <?php foreach($this->data as $v):?>
                        <tr class="<?php echo $v['process'] == 100 ? "finished" :"";?>">
                            <td><?php echo $v['id'];?></td>
                            <td><?php echo $v['title'];?></td>
                            <td><?php echo $v['process'];?>%</td>
                            <td><?php echo $v['owner'];?></td>
                            <td><?php echo $v['updated'];?></td>
                            <td>
                                <a href="<?php echo U(getv('controller').'/edit/id/'.$v['id']);?>">修改</a>
                                <a href="<?php echo U(getv('controller').'/del/id/'.$v['id']);?>" onclick="javascript:return confirm('你确定要删除吗？');">删除</a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        <?php else:?>
                        <tr>
                            <td colspan="6" align="center">暂无任务列表</td>
                        </tr>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
</body>
</html>