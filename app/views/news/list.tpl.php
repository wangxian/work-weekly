<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo SOURCE;?>/css/admin.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="main-wrap">
    <div class="path"><span class="path-icon"></span>当前位置：新闻管理<span> &gt; </span>列表</div>
    <div class="set-wrap">
        <h4 class="main-title">新闻管理</h4>
        <div class="set-area-int">

            <div class="user-list-box1">
                <p class="serch-tips"></p>
                <div class="serch-user">
                    <form method="post" id="form1" action="" >
                        <span><strong>搜索包含以下标题的项：</strong></span>
                        <span>
                            <input type="text" class="input-box box-address-width" name="keyword" id="keyword" value="<?php echo empty($this->keyword)?'':$this->keyword;?>" />
                            <input type="hidden" name="search_field" value="title" /> <!-- keyworld对那个字段搜索,value为字段名 -->
                        </span>
                        <span class="serch-btn"><input type="submit" value="搜索" name="" /></span>
                        <span id="nameTip" class="a-error hidden"></span>
                    </form>
                   </div>
            </div>
            <div class="user-list">
                <p>根据条件匹配出的结果如下。如果你不明白这些数据代表的意义，请联系管理员。</p>
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-border">
                    <thead class="td-title-bg">
                          <tr>
                            <td>编号</td>
                            <td>标题</td>
                            <td>所属分类</td>
                            <td>首页显示？</td>
                            <td>更新时间</td>
                            <td>操作</td>
                          </tr>
                    </thead>
                    <tbody>
                        <?php
                        $arr = array(
                            "1" => "<span style='color:red'>新闻动态</span>",
                            "0" => "<span style='color:blue'>二者都是</span>",
                            "-1" => "<span style='color:green'>活动公告</span>",
                        );
                        ?>
                        <?php if(!empty($this->data['data'])):?>
                        <?php foreach($this->data['data'] as $v):?>
                        <tr>
                            <td><?php echo $v['id'];?></td>
                            <td><?php echo $v['title'];?></td>
                            <td><?php echo $arr[$v['news_type']];?></td>
                            <td><?php echo $v['is_hot']==1?"已显示到首页":"";?></td>
                            <td><?php echo $v['updated'];?></td>
                            <td>
                                <?php if($v['is_hot']==1):?>
                                <a class="change-icon" href="<?php echo U(getv('controller').'/setHot/id/'.$v['id']);?>?t=0" style="color:green;">取消推荐到首页</a><br />
                                <?php else: ?>
                                <a class="change-icon" href="<?php echo U(getv('controller').'/setHot/id/'.$v['id']);?>?t=1" style="color:red;">推荐到首页</a><br />
                                <?php endif;?>

                                <a class="change-icon" href="<?php echo U(getv('controller').'/edit/id/'.$v['id']);?>">修改</a>
                                <a class="del-icon" href="<?php echo U(getv('controller').'/del/id/'.$v['id']);?>" onclick="javascript:return confirm('你确定要删除吗？');">删除</a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        <tr>
                            <td colspan="6" align="center"><?php echo $this->linkbar;?></td>
                        </tr>
                        <?php else:?>
                        <tr>
                            <td colspan="6" align="center">无内容</td>
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
