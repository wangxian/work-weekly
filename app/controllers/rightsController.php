<?php
/**
 +------------------------------------------------------------------------------
 * 用户权限控制器
 +------------------------------------------------------------------------------
 * @version   1.0
 * @author    WangXian
 * @filename ./controllers/rightsController.php
 * @creation date 2010-6-1 9:32:57
 * @modified date 2010-11-26 0:27:10
 +------------------------------------------------------------------------------
 */
class rightsController extends rootController
{
	/** 管理员list。*/
	public function sysuserMgrAction()
	{
		$this->view->all_user = M('sysuser')->getAllUsers();
		$this->view->render();
	}

	/** 添加管理员。*/
	public function sysuserAddAction()
	{
		$sysuser = new sysuserModel();
		$this->view->groups = $sysuser->getAllGroups();

		if(postv('submit'))
		{
			$_POST['cdate'] = date('Y-m-d H:i:s');
			$_POST['password_nohash'] = $_POST['password'];
			$_POST['password'] = md5($_POST['password']);

			//dumpdie($_POST);
			unset($_POST['submit']);

			if($sysuser->add_user($_POST)) show_success("恭喜，添加管理员成功 ！");
			else show_error("非常遗憾，添加管理员失败 ！");
		}
		$this->view->render();
	}

	public function sysuserDelAction()
	{
		$id = (int)$_GET['uid'];
		if(! empty($id))
		{
			$m = M('sysuser');
			if( $m->userDel($id) )
			{
				show_success('删除用户成功！' );
			}
			else
			{
				show_error('删除用户失败！' );
			}
		}
		{
			show_error('非法请求！', U('public/blank'));
		}
	}

	/** 管理员编辑。*/
	public function sysuserModiAction()
	{
		$sysuser = new sysuserModel();
		if(postv('submit') && getv('uid'))
		{
			if(postv('password'))
			{
				$_POST['password_nohash'] = $_POST['password'];
				$_POST['password'] = md5($_POST['password']);
			}
			else
			{//不修改密码，unset不删除password项，所以先赋值。
				$_POST['password'] = '';
				unset($_POST['password']);
			}

			//删除按钮的值
			unset($_POST['submit']);

			if($sysuser->add_user($_POST,getv('uid'))) show_success("恭喜，操作成功！");
			else show_error("非常遗憾，操作失败！");
		}
		elseif( getv('uid') )
		{
			$this->view->groups = $sysuser->getAllGroups();
			$this->view->user_info = $sysuser->getUserInfo((int)$_GET['uid']);

			$this->view->render();
		}
		else
		{
			show_error('非法请求！');
		}
	}

	//group list
	public function groupMgrAction()
	{
		$this->view->data = M('sysuser')->getAllGroups();
		$this->view->render();

	}

	public function groupDelAction()
	{
		$id = (int)$_GET['gid'];
		if(! empty($id))
		{
			$m = M('sysuser');
			if( $m->groupDel($id) )
			{
				show_success('删除用户成功！' );
			}
			else
			{
				show_error('删除用户失败！' );
			}
		}
		{
			show_error('非法请求！',0);
		}
	}

	/** 添加组。 **/
	public function groupAddAction()
	{
		if(postv('name'))
		{
			$sysuser = new sysuserModel();
			if( $sysuser->add_group( postv('name') ) ) show_success("添加成功！", U('rights/groupMgr'));
			else show_error("操作失败 -_-");
		}
		$this->view->render();
	}

	/** 修改组信息。 **/
	public function groupModiAction()
	{
		if(postv('gid'))
		{
			if( M('sysuser')->updateGroupInfo($_POST))
			{
				show_success('更新成功！', U('rights/groupMgr'));
			}
			else
			{
				show_error('更新失败！');
			}

		}
		elseif( getv('gid') )
		{
			$this->view->data = M('sysuser')->getGroupInfo( getv('gid') );
		}

		$this->view->render();

	}

	/** 权限管理。 */
	public function mgrAction()
	{
		$allGroups = M('sysuser')->getAllGroups();
		krsort($allGroups);
		$this->view->allGroups = $allGroups;
		$rights = new rightsModel();

		$gid = empty($_GET['gid']) ? 1 : $_GET['gid'];
		if(!empty($_POST))
		{
			unset($_POST['submit']);
			$rights->del_rights_bygid($gid);
			$data['group_id'] = $gid;
			foreach ($_POST as $k=>$v)
			{
				$data['controller']=$k;
				$data['action']=json_encode($v);
				$rights->add_rights($data);
				//echo $rights->getLastSql();
			}
            if($gid == 1) exit('<script type="text/javascript">parent.window.location.href=\''. U('index/logout') .'\';</script>');
			show_success('操作成功！', U('rights/mgr/gid/'.$gid) );
		}

		$crights = $rights->get_gid_rights($gid);
		$tmp=array();
		if(!empty($crights))
		{
			foreach ($crights as $v4)
			{
				if($v4['action'] == 'all') $tmp[$v4['controller']] = 'all';
				else if($v4['action'] == 'none') continue;
				else $tmp[$v4['controller']] = json_decode($v4['action']);
			}
		}
		$this->view->crights = $tmp;
		//dump($tmp);

		$this->view->render();
	}
}
/* End of file rightsController.php */
/* Location: ./_app/controllers/rightsController.php */