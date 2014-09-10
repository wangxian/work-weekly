<?php
 /**
 +------------------------------------------------------------------------------
 * 用户权限数据模型
 +------------------------------------------------------------------------------
 * @Version  2.2
 * @Author   WangXian
 * @E-mail    admin@loopx.cn
 * @FileName  rightsModel.php
 * @Creation  date 2010-11-23 下午05:26:38
 * @Modified  date 2010-11-23 下午05:26:38
 +------------------------------------------------------------------------------
 */
class rightsModel extends model
{

//	function rightsModel()
//	{
//		//$this->db = new db();
//	}

	/** 根据group_id查询组权限 **/
	public function get_gid_rights($group_id)
	{
		return $this->table('admin_sysrights')->where("group_id='{$group_id}'")->findAll();
	}


	/** 添加一个用户组权限 **/
	function add_rights($arr)
	{
		$count = $this->table('admin_sysrights')->where("group_id='{$arr['group_id']}' and controller='{$arr['controller']}'")
					  ->count();
		#组控制器已存在！
		if($count) return false;

		return $this->table('admin_sysrights')->set($arr)->insert();
	}

	/** 删除用户组权限 **/
	function del_rights($id)
	{
		return $this->table('admin_sysrights')->where("id='{$id}'")->delete();
	}

	/** 删除一个用户组所有的权限。 */
	function del_rights_bygid($gid)
	{
		return $this->table('admin_sysrights')->where("group_id='{$gid}'")->delete();
	}

	/** 根据id查询权限 **/
	function get_right_byid($id)
	{
		$sql = "select a.*,b.name group_name from admin_sysrights a left join admin_sysgroup b on a.group_id=b.id where a.id='". $id . "'";
		return $this->query($sql)->find();
	}

	/** 修改权限 **/
	function edit_rights($id, $actions)
	{
		$sql = "update admin_sysrights set action='". $actions ."' where id='". $id ."'";

		return $this->query($sql);
	}
}