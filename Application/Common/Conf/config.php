<?php
return array(
	//数据库配置信息
	'DB_TYPE'    => 'mysql', // 数据库类型
	'DB_HOST'    => 'localhost', // 服务器地址
	'DB_NAME'    => 'luomansi', // 数据库名
	'DB_USER'    => 'root', // 用户名
	//'DB_PWD'     => 'lmsmysql2018', // 密码
	'DB_PWD'     => '',

	'DB_PREFIX'  => 'saleman_', // 数据库表前缀
	'DB_CHARSET' => 'utf8', // 字符集
	'DB_DEBUG'   => false, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增

	// 开启路由
   // 'URL_ROUTER_ON'   => true,
    // 显示页面Trace信息
	'SHOW_PAGE_TRACE' =>true,
	// URL模式
    'URL_MODEL' => 1,

    //简化模板的目录层次
    'TMPL_FILE_DEPR'	=>	'_',
    'TAGLIB_BEGIN'      =>  '<{',            // 模板引擎普通标签开始标记
    'TAGLIB_END'        =>  '}>',            // 模板引擎普通标签结束标记
	'TMPL_L_DELIM'      =>  '<{',            // 模板引擎普通标签开始标记
    'TMPL_R_DELIM'      =>  '}>',            // 模板引擎普通标签结束标记

);