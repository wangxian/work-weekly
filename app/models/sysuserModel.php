<?php
 /**
 +------------------------------------------------------------------------------
 * user model
 +------------------------------------------------------------------------------
 * @Version  2.2
 * @Author   WangXian
 * @E-mail    admin@loopx.cn
 * @FileName  sysuserModel.php
 * @Creation  date 2010-11-23 下午04:41:57
 * @Modified  date 2010-11-23 下午04:41:57
 +------------------------------------------------------------------------------
 */
class sysuserModel extends model
{
    function __construct()
    {
        //$this->db = new db();
    }

    /**
     * 获取管理员信息
     * @param string $username
     */
    public function user_info($username)
    {
        return $this->table('admin_sysuser m,admin_sysgroup n')->select('m.*,n.name group_name')
                    ->where("m.group_id=n.id and username='". $this->escape_string($username) ."'")
                    ->find();
    }

    /**
     * 更新用户登录的时间和登陆次数
     * @param integer $uid
     */
    public function login_log($uid)
    {
        $data['logincount']    = 'logincount+1';
        $data['lastlogintime'] = time();

        return $this->table('admin_sysuser')->set($data, array('logincount'))->where("id={$uid}")->update();
    }

    /**
     * 新增用户
     * @param array $data
     * @param int $uid
     */
    public function add_user($data,$uid=0)
    {
        if($uid)
            return $this->table('admin_sysuser')->set($data)->where('id='.$uid)->update();
        else
            return $this->table('admin_sysuser')->set($data)->insert();
    }

    /**
     * 添加用户组
     * @param string $group_name
     */
    public function add_group($group_name)
    {
        return $this->table('admin_sysgroup')->set( array('name'=>$group_name) )->insert();
    }

    /**
     * 查询所有用户
     */
    function getAllUsers()
    {
        $sql = "select a.*,b.name group_name from admin_sysuser a left join admin_sysgroup b on a.group_id = b.id order by a.id desc";
        return $this->query($sql)->findAll();
    }

    /**
     * 删除用户
     * @param int $uid
     */
    public function userDel($uid)
    {
        return $this->query("delete from admin_sysuser where id=". $uid);
    }

    /**
     * 获取用户id信息
     * @param int $uid
     */
    public function getUserInfo($uid)
    {
        $user = $this->query("select * from admin_sysuser where id=". $uid)->find();
                //unset($user['password']);
                return $user;
    }

    /**
     * 查询所有的用户组
     */
    public function getAllGroups()
    {
        return $this->query('select * from admin_sysgroup order by id desc')->findAll();
    }

    /**
     * 获取用户组信息
     * @param $gid
     */
    public function getGroupInfo($gid)
    {
        return $this->query("select * from admin_sysgroup where id=". $gid)->find();
    }

    /**
     * 更新用户组信息
     * @param array $post
     */
    public function updateGroupInfo($post)
    {
        $data['name'] = $post['name'];
        return $this->table('admin_sysgroup')->set($data)->where('id='.$post['gid'])->update();
    }

    /**
     * 删除组
     * @param integer $gid
     */
    public function groupDel($gid)
    {
        return $this->query("delete from admin_sysgroup where id=". $gid);
    }

}