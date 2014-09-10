<?php
 /**
 +------------------------------------------------------------------------------
 * 后台菜单节点
 +------------------------------------------------------------------------------
 * @Version  2.2
 * @Author   WangXian
 * @E-mail    admin@loopx.cn
 * @FileName  menu.config.php
 * @Creation  date 2010-11-26 上午09:39:40
 * @Modified  date 12011-04-18 10:53
 +------------------------------------------------------------------------------
 */

return array
(
    'task'=>
     array(
         'title'=>'任务管理',
         'menu_group'=>
         array(
              '任务管理' => array(
                'task/list'=> '我的任务',
                'task/list_all'=> '项目任务',
                'task/add' => '任务添加',
              ),
         ),
         'actions'=>
          array(
              'task/list' => '我的任务-列表',
              'task/list_all' => '项目任务-列表',
              'task/add'  => '任务-添加',
              'task/edit' => '任务-编辑',
              'task/del'  => '任务-删除',
         ),
     ),

     'weekly'=>
     array(
         'title'=>'周报管理',
         'menu_group'=>
         array(
              '课程安排' => array(
                'weekly/list'=>'我的周报',
                'weekly/list_all'=>'项目周报',
              ),
         ),
         'actions'=>
          array(
              'weekly/list'=>'周报-列表',
              'weekly/add'=>'周报-添加',
              'weekly/edit'=>'周报-编辑',
              'weekly/del'=>'周报-删除',
         ),
     ),

    'staff'=>
     array(
         'title'=>'员工管理',
         'menu_group'=>
         array(
              '课程安排' => array(
                'staff/list'=>'项目组员工',
                'staff/add'=>'增加项目员工',
              ),
         ),
         'actions'=>
          array(
              'staff/list'=>'员工-列表',
              'staff/add'=>'员工-添加',
              'staff/edit'=>'员工-编辑',
              'staff/del'=>'员工-删除',
         ),
    ),

    'rights'=>
     array
     (
        'title'=>'权限管理',
         'menu_group'=>
          array(
              '帐号管理'    => array(
                'rights/sysuserMgr'=>'管理员-列表',
                'rights/sysuserAdd'=>'管理员-添加'
              ),
              '管理员组'    => array(
                'rights/groupMgr'=>'管理员组-列表',
                'rights/groupAdd'=>'管理员组-添加'
              ),
              '权限管理'    => array(
                'rights/mgr'=>'权限管理'
              ),
          ),
          'actions'=>
           array(
              'rights/mgr'         =>'权限管理',

               'rights/sysuserAdd'  =>'管理员-添加',
              'rights/sysuserMgr'  =>'管理员-列表',
               'rights/sysuserDel'  =>'管理员-删除',
               'rights/sysuserModi' =>'管理员-修改',

              'rights/groupAdd'    =>'管理组-添加',
               'rights/groupMgr'    =>'管理组-列表',
               'rights/groupModi'   =>'管理组-修改',
               'rights/groupDel'    =>'管理组-删除',
          ),
     ),
);

/* End of file menu.config.php */
/* Location: menu.config.php */