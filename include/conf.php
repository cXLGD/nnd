<?php
	// 配置
	




	define('ROOT','http://'.$_SERVER['HTTP_HOST']);

	// css目录 路径
	define('CSS_DIR',ROOT.'/static/styles/');
	// js目录
	define('JS_DIR',ROOT.'/static/scripts/');
	// 图片目录
	define('IMG_DIR',ROOT.'/static/images/');

	// 表前缀
	$conf = array();
	

	//加载函数库
	include 'functions.php';

	/**
	 * 数据库配置
	 * $host    主机
	 * $user    用户名
	 * $passwd  密码
	 * $conn    数据库链接
	 */
	$host = 'localhost';
	$user = 'root';
	$passwd = '';
	$dbname = 'nndou';

	db_connct($host,$user,$passwd,$dbname);




