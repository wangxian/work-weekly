<?php
class staffController extends rootController
{
    public function addAction()
    {
        $sysuser = new sysuserModel();
        if(postv('submit'))
        {
          $_POST['cdate'] = date('Y-m-d H:i:s');
          $_POST['password_nohash'] = $_POST['password'];
          $_POST['password'] = md5($_POST['password']);
          $_POST['parent_id'] = Session::get("sysuser.user_id");
          $_POST['group_id'] = 3;

          unset($_POST['submit']);
          // dumpdie($_POST);

          if($sysuser->add_user($_POST)) show_success("恭喜，添加成功 ！");
          else show_error("非常遗憾，添加失败 ！");
        }
        $this->view->render();
    }

    public function editAction()
    {
      $sysuser = new sysuserModel();
      if(postv('submit') && getv('id'))
      {
          if(postv('password'))
          {
              $_POST['password_nohash'] = $_POST['password'];
              $_POST['password'] = md5($_POST['password']);
          }
          else
          {
              // 不修改密码，unset不删除password项，所以先赋值。
              $_POST['password'] = '';
              unset($_POST['password']);
          }

          //删除按钮的值
          unset($_POST['submit']);

          if($sysuser->add_user($_POST, getv('id'))) show_success("恭喜，操作成功！");
          else show_error("非常遗憾，操作失败！");
      }
      elseif( getv('id') )
      {
          $this->view->data = $sysuser->getUserInfo(getv("id"));
          $this->view->render();
      }
      else
      {
          show_error('非法请求！');
      }
    }

    public function listAction()
    {
        $user_id = Session::get("sysuser.user_id");
        $this->view->data = $this->model->table("admin_sysuser")->where(array('parent_id'=> $user_id ))->findAll();
        $this->view->render();
    }

    function _getTableName()
    {
        return 'admin_sysuser';
    }
}