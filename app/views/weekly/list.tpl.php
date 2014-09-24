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
    <div class="path"><span class="path-icon"></span>当前位置：周报管理<span> &gt; </span><?php if(getv("action") == "list") echo "我的周报"; else echo "项目组周报";?></div>

    <?php if(!empty($this->data)):?>
    <?php foreach($this->data as $k=>$v):?>
    <div class="set-wrap">
        <h4 class="main-title">第 <?php echo $k;?> 周</h4>
        <div class="set-area-int">

            <div class="user-list">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-border">
                    <thead class="td-title-bg">
                          <tr>
                            <td width="60px">编号</td>
                            <td width="300px">标题</td>
                            <td width="40px">进度</td>
                            <td width="60px">所属员工</td>
                          </tr>
                    </thead>
                    <tbody>
                        <?php foreach($v as $v2):?>
                        <tr class="<?php echo $v2['process'] == 100 ? "finished" :"";?>">
                            <td><?php echo $v2['id'];?></td>
                            <td><?php echo $v2['title'];?></td>
                            <td><?php echo $v2['process'];?>%</td>
                            <td><?php echo $v2['owner'];?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <?php endforeach;?>
    <?php else:?>
    <h1>暂无周报</h1>
    <?php endif;?>
</div>

</body>
</html>