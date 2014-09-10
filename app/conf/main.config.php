<?php
/**
 +------------------------------------------------------------------------------
 * 应用程序，主配置
 +------------------------------------------------------------------------------
 * @Version   1.2
 * @Author    WangXian
 * @E-mail     admin@loopx.cn
 * @package  framework
 * @FileName main.config.php
 * @Creation date 2010-10-12
 * @Modified date 2010-10-12
 +------------------------------------------------------------------------------
 */

return array
(
    'debug'                => false,    #调试模式，默认开启

    /* 打印log相关配置 */
    'access_log'           => false,    #是否记录access_log日志
    'exception_log'        => false,     #是否记录EXCEPTION日志
    'sql_log'              => false,    #是否记录SQL日志

    /* 系统相关配置  */
    'show_errors'        => true,        #是否显示系统错误信息，true显示，false不显示。
    'dbdriver'           => 'mysqli',    #选择db驱动，mysql|mysqli|sqlite 默认mysqli
    'cache_type'         => 'FileCache', #可选,FileCache | MemCache 分别为文件缓存、MemCache缓存


    /* URL相关 */
    'html_url_suffix'    => '.html',         #伪静态后缀设置
    'url_router'         => false,         #是否启用url路由功能
    'url_type'           => 'PATH_INFO',    #url类型PATH_INFO|GET|SEO, SEO模式采用PATH_INFO但无入口index.php等；

    /* 其他配置。 */
    'assets_dir'        => '/assets',          #资源目录位置，如/assets，存放资源文件的目录(域名后的资源文件夹名)，最后不带 ‘/’

    'tpl_success'       => 'success.tpl.php',    #show_success()用的模板文件,如：success.tpl.html,文件放在_app/views/public/success.tpl.php.如果为空，那么使用系统默认模板。
    'tpl_error'         => 'error.tpl.php',        #show_error()用的模板文件,同上
//    'tpl_404'            => '404.tpl.html'        #show_404()用的模板文件,同上

);


/* End of file ./conf/main.config.php */
/* Location: main.config.php */