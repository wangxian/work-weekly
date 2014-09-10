<?php
class newsController extends rootController
{
    protected function _list($table_name)
    {
        // $m = new model();
        // for($i=0;$i<40;$i++)
        // {
        //   $m->table("b_article")->set(array(
        //     "title"=>"上任5年从未回避两岸政治议题".$i,
        //     "category"=>"news",
        //     "news_type"=>1,
        //     "created"=>date("Y-m-d H:i:s"),
        //   ))->insert();
        // }

        $page = getv('page',1);
        $page_count = 12;

        $keyword = requestv('keyword');
        $search_field = requestv('search_field');
        if(! $keyword )
        {
            // $where = "category in ('news_xinwen','news_huodong')";
            $where = "category='news'";
            $urlx = '';
        }
        else
        {
            $where = "category = 'news' AND ". $search_field .' LIKE \'%'.$this->model->escape_string($keyword).'%\'';
            $urlx = "/search_field/{$search_field}/keyword/".urlencode($keyword);
        }
        $this->view->keyword = $keyword;
        $this->view->data = $this->model->table($table_name)->where($where)->limit( ($page-1)*$page_count, $page_count)->orderby('id desc')
                                 ->findPage();
        // echo $this->model->sql;

        $link = new Link( getv('page',1),$this->view->data['data_count'],U(getv('controller').'/'.getv('action').$urlx), $page_count);
        $this->view->linkbar = $link->show(3);
        $this->view->render();
    }

    function _getTableName()
    {
        return 'b_article';
    }
}