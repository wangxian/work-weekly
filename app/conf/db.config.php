<?php
/**
 +------------------------------------------------------------------------------
 * 数据库配置
 +------------------------------------------------------------------------------
 * @version   4.0
 * @author    WangXian
 * @filename db.config.php
 * @creation date 2010-7-12 11:19:22
 * @modified date 2012-7-17
 +------------------------------------------------------------------------------
 */
return array
(
    /* default */
    'default'=>
     array
     (
        'host'          => '127.0.0.1',
        'user'          => 'root',
        'password'      => '111111',
        'dbname'        => 'work-weekly',
        'tb_prefix'     => 'b_'
     ),

    'master'=>
     array
     (
        'host'        => '127.0.0.1',
        'user'        => 'root',
        'password'    => '',
        'dbname'    => '',
     ),
);