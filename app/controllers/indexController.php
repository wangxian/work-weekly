<?php
 /**
 +------------------------------------------------------------------------------
 * 管理首页
 +------------------------------------------------------------------------------
 * @Version  3.2
 * @Author   WangXian
 * @E-mail    admin@loopx.cn
 * @FileName  indexController.php
 * @Creation  date 2010-11-23 下午02:30:42
 * @Modified  date 2011-4-9 20:18:52
 +------------------------------------------------------------------------------
 */


class indexController extends controller
{
    public function __construct()
    {
        Session::init();
        if( empty($_SESSION['sysuser']) && $_GET['action'] != 'login') R( U('index/login') );
        $this->view = new view();
    }

    function indexAction()
    {
        $menu = C('','menu');
        foreach ($menu as $k=>$v1)
        {
            $this->view->menu1[$k] = $v1['title'];
            $this->view->menu2[$k] = $v1['menu_group'];
        }
//        dump($_SESSION['rights']);
//        dump($this->view,'',0);
        $this->view->render('index.tpl.php');
    }

//-----------------test
    function xheditorAction()
    {
      	$this->view->render();
    }

    function swfuploadAction()
    {
        $this->view->render();
    }

    /** 登陆界面。 **/
    public function loginAction()
    {
        if( postv('username') && postv('password') )
        {

            $sysuser = new sysuserModel();
            try
            {
                $result = $sysuser->user_info(postv('username'));
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
                #用户不存在
                echo json_encode( array('state'=>1021,'msg'=>'Server 500 Error') );
                exit;
            }


            if( empty($result) )
            {
                #用户不存在
                echo json_encode( array('state'=>1021,'msg'=>'用户不存在') );
                exit;
            }

            if( $result['password'] != md5( postv('password') ) )
            {
                #密码错误
                echo json_encode( array('state'=>1022,'msg'=>'密码错误') );
                exit;
            }

            #记录session
            $_SESSION['sysuser']['user_id']        = $result['id'];
            $_SESSION['sysuser']['username']    = $result['username'];
            $_SESSION['sysuser']['group_id']    = $result['group_id'];
            $_SESSION['sysuser']['group_name']    = $result['group_name'];
            $_SESSION['sysuser']['realname']    = $result['realname'];
            $_SESSION['rights'] = array();

            #查询用户权限action
            $rights = new rightsModel();
            $result2 = $rights->get_gid_rights($result['group_id']);

            #记录用户权限
            if( !empty($result2) )
            {
                foreach($result2 as $v)
                {
                    $_SESSION['rights'][ $v['controller'] ] = json_decode($v["action"]);
                }
            }

            #增加用户额外权限。
            if( !empty($result['add_rights']) )
            {
                $_SESSION['rights'] = array_merge($_SESSION['rights'], json_decode($result['add_rights'],true));
            }

            //更新登陆次数和最后登陆时间
            $sysuser->login_log($result['id']);
            //R( U('index/index') );

            #密码错误
            echo json_encode( array('state'=>200) );
            exit;
        }

        $this->view->render('login.tpl.php');
    }


    /** 后台用户退出。 **/
    public function logoutAction()
    {
        $_SESSION=null;
        R(U('index/login'));
    }

    /** 后台用户修改个人资料。 **/
    public function myaccountAction()
    {
        $sysuser = new sysuserModel();
        if(postv('submit'))
        {
            if(postv('password'))
            {
                $_POST['password_nohash'] = $_POST['password'];
                $_POST['password'] = md5($_POST['password']);
            }
            else
            {//不修改密码,unset不删除password项，所以先赋值。
                $_POST['password'] = '';
                unset($_POST['password']);
            }
            //删除按钮的值
            unset($_POST['submit']);

            if($sysuser->add_user( $_POST, $_SESSION['sysuser']['user_id'] ) ) show_success("恭喜你，操作成功！");
            else show_error("非常遗憾，操作失败！");
        }
        else
        {
            $this->view->data = $sysuser->getUserInfo($_SESSION['sysuser']['user_id']);
            $this->view->render();
        }
    }

    /** 后台欢迎界面。 **/
    public function blankAction()
    {
        $this->view->info = array(
            '操作系统'=>PHP_OS,
            '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式'=>php_sapi_name(),
            'PHP版本'=>PHP_VERSION,
            '上传附件限制'=>ini_get('upload_max_filesize'),
            '执行时间限制'=>ini_get('max_execution_time').'秒',
            '服务器时间'=>date("Y年n月j日 H:i:s"),
            '北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
            '服务器域名/IP '=>$_SERVER['SERVER_NAME'].' [ '.$_SERVER['SERVER_ADDR'].' ]',
//            '剩余空间'=>round((@disk_free_space(".")/(1024*1024)),2).'M',
//            'register_globals '=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
//            'magic_quotes_gpc '=>(1===get_magic_quotes_gpc())?'YES':'NO',
//            'magic_quotes_runtime   '=>(1===get_magic_quotes_runtime())?'YES':'NO',
            );

        $this->view->render();
    }
}

/* End of file indexController.php */
/* Location: indexController.php */