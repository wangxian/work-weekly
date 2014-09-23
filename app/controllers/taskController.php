<?php
class taskController extends rootController
{
    public function addAction()
    {
        if(!empty($_POST['submit']))
        {
            $data = $_POST;
            $data["created"] = date("Y-m-d H:i:s");
            unset($data['submit']);
            $data["week"] = date("YW");

            if(empty($data["staffs"])) show_error("必须把任务分配给一个员工！");
            $staffs = $data["staffs"];
            unset($data["staffs"]);

            $data["owner"] = implode(",", array_values($staffs));
            // dumpdie( array_keys($data["owner"]) );


            $user_id = Session::get("sysuser.user_id");
            $task_id = $this->model->table( "admin_task" )->set($data)->insert();


            $staffs_ids = array_keys($staffs);
            foreach ($staffs_ids as $v)
            {
                $this->model->table( "admin_user_task" )->set(array("user_id"=>$v, "task_id"=>$task_id))->insert();
            }
            show_success('恭喜，操作成功！');
        }

        // 分配任务给谁
        if(Session::get("sysuser.group_id") == '3')
        {
            // 个人只能把任务分配给自己
            $this->view->owner = array("id"=>Session::get("sysuser.user_id"), "username" => Session::get("sysuser.username"));
        }
        else
        {
            // 管理员，能分配给所有人
            $user_id = Session::get("sysuser.user_id");
            // $user_id = 86;// for test
            $this->view->owner = $this->model->query("select id,username from admin_sysuser where parent_id='{$user_id}'")->findAll();
            // echo $this->model->sql;
        }
        // dumpdie($this->view->owner);


        $this->view->render();
    }

    public function listAction()
    {
        $week = date("YW");
        $user_id = Session::get("sysuser.user_id");
        $this->view->data = $this->model->query("select a.*,b.username from admin_task a,admin_sysuser b,admin_user_task c where a.id = c.task_id and b.id=c.user_id and b.id={$user_id} and a.week='{$week}' order by a.id desc")->findAll();
        // dump($this->view->data);
        $this->view->render("task/list");
    }

    public function list_allAction()
    {
        $week = date("YW");
        $this->view->data = $this->model->query("select a.*,b.username from admin_task a,admin_sysuser b,admin_user_task c where a.id = c.task_id and b.id=c.user_id and a.week='{$week}' group by a.id order by a.id desc")->findAll();
        // dump($this->view->data);
        // echo $this->model->sql;
        $this->view->render("task/list");
    }

    protected function _edit($table_name)
    {
        if(! getv('id') ) show_error('非法请求!', 0);
        if(!empty($_POST['submit']))
        {
            $data = $_POST;
            unset($data['submit']);

            if(empty($data["staffs"])) show_error("必须把任务分配给一个员工！");
            $staffs = $data["staffs"];
            unset($data["staffs"]);

            $data["owner"] = implode(",", array_values($staffs));
            // dumpdie( array_keys($data["owner"]) );
            $task_id = getv("id");
            $this->model->table("admin_user_task")->where(array("task_id"=>$task_id))->delete();

            $staffs_ids = array_keys($staffs);
            foreach ($staffs_ids as $v)
            {
                $this->model->table( "admin_user_task" )->set(array("user_id"=>$v, "task_id"=>$task_id))->insert();
            }

            if( $this->model->table( $table_name )->where( array("id"=>$task_id) )->set($data)->update() )
            {
                show_success('恭喜，操作成功！');
            }
            else
            {
                show_error('抱歉，操作失败，请与管理员联系！');
            }
        }
        else
        {
            $this->view->data = $this->model->table($table_name)->where( array("id"=>getv("id")) )->find();
        }

        // 该任务，已经分配给谁？
        $_users = $this->model->select('user_id')->table("admin_user_task")->where( array("task_id"=>getv("id")) )->findAll();
        $yet_users = array();
        foreach ($_users as $v)
        {
            $yet_users[] = $v["user_id"];
        }
        // dumpdie($yet_users);
        $this->view->yet_users = $yet_users;

        // 分配任务可以给谁
        if(Session::get("sysuser.group_id") == '3')
        {
            // 个人只能把任务分配给自己
            $this->view->owner = array("id"=>Session::get("sysuser.user_id"), "username" => Session::get("sysuser.username"));
        }
        else
        {
            // 管理员，能分配给所有人
            $user_id = Session::get("sysuser.user_id");
            // $user_id = 86;// for test
            $this->view->owner = $this->model->query("select id,username from admin_sysuser where parent_id='{$user_id}'")->findAll();
            // echo $this->model->sql;
        }
        // dumpdie($this->view->owner);

        $this->view->render();
    }

    // public function editAction()
    // {
    //     if(! getv('id') ) show_error('非法请求!', 0);
    //     if(!empty($_POST['submit']))
    //     {
    //         $data = $_POST;
    //         unset($data['submit']);

    //         if( $this->model->table( $table_name )->where( array("id"=>getv("id")) )->set($data)->update() )
    //             show_success('恭喜，操作成功！');
    //         else
    //             show_error('抱歉，操作失败，请与管理员联系！');
    //     }
    //     else
    //         $this->view->data = $this->model->table($table_name)->where( array("id"=>getv("id")) )->find();
    //     $this->view->render();
    // }

    function _getTableName()
    {
        return 'admin_task';
    }
}