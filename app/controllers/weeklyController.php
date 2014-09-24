<?php
class weeklyController extends rootController
{
    public function listAction()
    {
        $user_id = Session::get("sysuser.user_id");
        $tmp = $this->model->query("select a.* from admin_task a left join admin_user_task b on a.id = b.task_id where b.user_id={$user_id} order by a.id desc")->findAll();

        $data = array();
        foreach($tmp as $v)
        {
            $data[$v["week"]][] = $v;
        }
        $this->view->data = $data;
        // dump($this->view->data);
        $this->view->render("weekly/list");
    }

    public function list_allAction()
    {
        $week = date("YW");
        $user_id = Session::get("sysuser.user_id");
        $tmp = $this->model->query("select a.* from admin_task a left join admin_user_task b on a.id = b.task_id where b.user_id in (select id from admin_sysuser where parent_id={$user_id}) order by a.id desc")->findAll();

        $data = array();
        foreach($tmp as $v)
        {
            $data[$v["week"]][] = $v;
        }
        $this->view->data = $data;
        // dump($this->view->data);
        $this->view->render("weekly/list");
    }

    function _getTableName()
    {
        return 'admin_task';
    }
}