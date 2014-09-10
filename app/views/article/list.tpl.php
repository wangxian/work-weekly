<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo SOURCE;?>/css/admin.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="main-wrap">
	<div class="path"><span class="path-icon"></span>当前位置：文章管理<span> &gt; </span>文章列表</div>
    <div class="set-wrap">
        <h4 class="main-title">文章列表</h4>
		<div class="set-area-int">

			<div class="user-list-box1">
				<p class="serch-tips"></p>
            	<div class="serch-user">
            		<form method="post" id="form1" action="" >
            			<span><strong>搜索包含以下标题的文章：</strong></span>
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
	    					<td width="60px">编号</td>
	    					<td width="300px">标题</td>
	                        <td width="140px">所属主题站</td>
                            <td width="100px">作者</td>
                            <td width="140px">发布时间</td>
	    					<td width="150px">操作</td>
	  					</tr>
	                </thead>
	                <tbody>
	                	<?php if(!empty($this->data['data'])):?>
						<?php foreach($this->data['data'] as $v):?>
						<tr>
							<td><?php echo $v['id'];?></td>
							<td><?php echo $v['title'];?></td>
                            <td><?php echo $v['site_name'];?></td>
                            <td><?php echo $v['author'];?></td>
							<td><?php echo $v['created'];?></td>
							<td>
								<a class="" href="<?php echo U(getv('controller').'/edit/id/'.$v['id']);?>">修改</a>

                                <?php if(empty($v['show_index'])):?>
                                <a class="" href="<?php echo U(getv('controller').'/show_index/set/1/id/'.$v['id']);?>" style="color:green">首页推荐</a>
                                <?php else:?>
                                <a class="" href="<?php echo U(getv('controller').'/show_index/set/0/id/'.$v['id']);?>" style="color:red;">取消推荐</a>
                                <?php endif;?>
                                <a class="" href="<?php echo U(getv('controller').'/del/id/'.$v['id']);?>" onclick="javascript:return confirm('你确定要删除吗？');">删除</a>
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