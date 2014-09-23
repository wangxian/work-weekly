<?php
class articleController extends rootController
{
    function addAction()
    {
        if(!empty($_POST['submit']))
		{
            $basedir = $_SERVER['DOCUMENT_ROOT'].'/assets/attachments/article/';
            if(empty($_FILES['file']['tmp_name'])) show_error ('您似乎未上传主题站背景图');

			$data = $_POST;
            $data['created'] = date('Y-m-d H:i:s');
			unset($data['submit']);

            list($site_id, $site_name) = explode('|', postv('site_id'));

            $data['site_id']   = $site_id;
            $data['site_name'] = $site_name;

            $data['tags'] = trim(postv('tags'));

//            dump($data);exit;
            $id = $this->model->table( 'b_article' )->set($data)->insert();

            Image::thumbImg($_FILES['file']['tmp_name'], $basedir."{$id}.jpg", 460, 260);

			if( $id )
				show_success('恭喜，操作成功！');
			else
				show_error('抱歉，操作失败，请与管理员联系！');
		}
        $this->view->site = $this->model->table('b_site')->findAll();
		$this->view->render();
    }

    public function editAction()
    {
        $id = getv('id');

        if(!empty($_POST['submit']))
		{

            if(!empty($_FILES['file']['tmp_name']))
            {
                $basedir = $_SERVER['DOCUMENT_ROOT'].'/assets/attachments/article/';
                Image::thumbImg($_FILES['file']['tmp_name'], $basedir."{$id}.jpg", 460, 260);
            }

			$data = $_POST;
            $data['created'] = date('Y-m-d H:i:s');
			unset($data['submit']);

            list($site_id, $site_name) = explode('|', postv('site_id'));

            $data['site_id']   = $site_id;
            $data['site_name'] = $site_name;

            $data['tags'] = trim(postv('tags'));

            $ret = $this->model->table('b_article')
                       ->where( array('id'=>$id) )
                       ->set($data)->update();

			if( $ret ) show_success('恭喜，操作成功！');
			else show_error('抱歉，操作失败，请与管理员联系！');
		}

        $this->view->data = $this->model->table('b_article')->where(array('id'=>$id))->find();
        $this->view->site = $this->model->table('b_site')->findAll();
        parent::editAction();
    }

    public function delAction()
    {
        $id = getv('id');
        $md = $this->model->query('select sex from b_article a left join b_site b on a.site_id=b.id where a.id="'. $id .'"')->findObj();

        if(empty($md->sex)) show_error('文章所属分类已被删除,请先修改文章所属分类');
        else
        {
            if($md->sex == 'male')
            {
                $male = $this->model->query('select count(*) AS count from b_article a left join b_site b on a.site_id=b.id where a.show_index=1 and b.sex="male"')->findObj();
                if($male->count <= 2) show_error("首页推荐文章数，男推荐的必须大于等于2");
            }
            else
            {
                $female = $this->model->query('select count(*) AS count from b_article a left join b_site b on a.site_id=b.id where a.show_index=1 and b.sex="female"')->findObj();
                if($female->count <= 2) show_error("首页推荐文章数，女推荐的必须大于等于2");
            }
        }
        parent::delAction();
    }


    public function show_indexAction()
	{
        if(getv('set') == 0 )
        {
            $id = getv('id');
            $md = $this->model->query('select sex from b_article a left join b_site b on a.site_id=b.id where a.id="'. $id .'"')->findObj();

            if(empty($md->sex)) show_error('文章所属分类已被删除,请先修改文章所属分类');
            else
            {
                if($md->sex == 'male')
                {
                    $male = $this->model->query('select count(*) AS count from b_article a left join b_site b on a.site_id=b.id where a.show_index=1 and b.sex="male"')->findObj();
                    if($male->count <= 2) show_error("首页推荐文章数，男推荐的必须大于等于2");
                }
                else
                {
                    $female = $this->model->query('select count(*) AS count from b_article a left join b_site b on a.site_id=b.id where a.show_index=1 and b.sex="female"')->findObj();
                    if($female->count <= 2) show_error("首页推荐文章数，女推荐的必须大于等于2");
                }
            }
        }


		if( $this->model->table('b_article')->where("id='". getv('id') ."'")->data( array( 'show_index'=>getv('set') ) )->update() )
			show_success('恭喜，操作成功！');
		else show_error('抱歉，操作失败，请与管理员联系！');
	}
}