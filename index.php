<?php
/**
 +------------------------------------------------------------------------------
 *
 * ePHP is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * ePHP is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with ePHP.  If not, see <http://www.gnu.org/licenses/>.
 +------------------------------------------------------------------------------
 * @version 4.1
 * @author  WangXian
 * @package ePHP
 * @link	 http://code.google.com/p/php-framework-ePHP/
 * @E-mail   admin@loopx.cn
 * @creation date 2010-10-17
 * @modified date 2012-06-01
 +------------------------------------------------------------------------------
 */

header('Content-Type:text/html; charset=UTF-8');
//date_default_timezone_set($config['date_timezone']);

define("APP_PATH", dirname(__FILE__).'/app');
define("FW_PATH", '../ePHP-github/ePHP');

include FW_PATH . '/ePHP.php';	#加载框架入口

$app = new app();	#系统实例化及调度开始
$app->run();		#运行程序