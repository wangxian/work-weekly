<?php
 /**
 +------------------------------------------------------------------------------
 * root
 +------------------------------------------------------------------------------
 * @Version  3.3
 * @Author   WangXian
 * @E-mail    admin@loopx.cn
 * @FileName  rootController.php
 * @Creation  date 2010-11-23 下午03:58:19
 * @Modified  date 2011-4-9 20:35:48
 +------------------------------------------------------------------------------
 */

class rootController extends controller
{
    public $table_prefix='b_';
    function __construct()
    {
        Session::init();
        if( empty($_SESSION['sysuser']) )
        {
            exit('<script type="text/javascript">parent.window.location.href=\''. U('index/logout') .'\';</script>');
        }

        #无权限
        if( empty($_SESSION['rights'][ $_GET['controller'] ]) || !in_array($_GET['action'], $_SESSION['rights'][ $_GET['controller'] ]) )
        {
            show_error('访问拒绝， 您可能没有权限执行该操作， 请联系管理员以确认！', false, 2e5);
        }
        //dump($_SESSION['rights']);
    }

    /** 管理。*/
    public function listAction()
    {
        $this->_list( $this->_getTableName() );
    }

    /** 添加。*/
    public function addAction()
    {
        $this->_add( $this->_getTableName() );
    }

    /** 删除。*/
    public function delAction()
    {
        $this->_del( $this->_getTableName() );
    }

    /** 编辑。*/
    public function editAction()
    {
        $this->_edit( $this->_getTableName() );
    }

    public function setHotAction()
    {
        if(! getv('id') ) show_error('非法请求!', 0);
        if( $this->model->table("b_article")->where( array("id"=>getv('id',0)) )->set(array("is_hot"=> intval(getv("t", 0)) ))->update() )
            show_success('恭喜，设置成功！');
        else
            show_error('抱歉，操作失败，请与管理员联系！');
    }



//---------------------------------------------------------------------------------------
    protected function _list($table_name)
    {
        $page = getv('page',1);
        $page_count = 12;

        $keyword = requestv('keyword');
        $search_field = requestv('search_field');
        if(! $keyword )
        {
            $where = array();
            $urlx = '';
        }
        else
        {
            $where = $search_field .' LIKE \'%'.$this->model->escape_string($keyword).'%\'';
            $urlx = "/search_field/{$search_field}/keyword/".urlencode($keyword);
        }
        $this->view->keyword = $keyword;
        $this->view->data = $this->model->table($table_name)->where($where)->limit( ($page-1)*$page_count, $page_count)->orderby('id desc')
                                 ->findPage();

        $link = new Link( getv('page',1),$this->view->data['data_count'],U(getv('controller').'/'.getv('action').$urlx), $page_count);
        $this->view->linkbar = $link->show(3);
        $this->view->render();
    }

    protected function _add($table_name)
    {
        if(!empty($_POST['submit']))
        {
            $data = $_POST;
            $data["created"] = date("Y-m-d H:i:s");
            unset($data['submit']);

            if( $this->model->table( $table_name )->set($data)->insert() )
                show_success('恭喜，操作成功！');
            else
                show_error('抱歉，操作失败，请与管理员联系！');
        }
        $this->view->render();
    }

    protected function _del($table_name)
    {
        if(! getv('id') ) show_error('非法请求!', 0);
        if( $this->model->table($table_name)->where( array("id"=>getv("id")) )->delete() )
            show_success('恭喜，删除成功！');
        else
            show_error('抱歉，删除失败，请与管理员联系！');
    }

    protected function _edit($table_name)
    {
        if(! getv('id') ) show_error('非法请求!', 0);
        if(!empty($_POST['submit']))
        {
            $data = $_POST;
            unset($data['submit']);

            if( $this->model->table( $table_name )->where( array("id"=>getv("id")) )->set($data)->update() )
                show_success('恭喜，操作成功！');
            else
                show_error('抱歉，操作失败，请与管理员联系！');
        }
        else
            $this->view->data = $this->model->table($table_name)->where( array("id"=>getv("id")) )->find();
        $this->view->render();
    }

    /** 获取当前控制器的表名。*/
    protected function _getTableName()
    {
        return $this->table_prefix.getv('controller');
    }
}

/* End of file rootController.php */
/* Location: ./_app/controllers/rootController.php */