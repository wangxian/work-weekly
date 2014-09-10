<?php
class userController extends rootController
{
    public function delAction()
	{
		if( $this->model->table('b_user')->where("id='". getp(3) ."'")->data( array( 'deleted'=>getp(4) ) )->update() )
			show_success('恭喜，操作成功！');
		else show_error('抱歉，操作失败，请与管理员联系！');
	}

    public function editAction()
    {
        if( !empty($_POST) )
		{
            if(empty($_POST['password'])) unset($_POST['password']);
            else $_POST['password'] = md5($_POST['password']);
		}
		parent::editAction();
    }
}