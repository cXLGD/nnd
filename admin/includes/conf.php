<?php
	//配置文件

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
	$passwd = '123456';
	$dbname = 'nnd';

	db_connct($host,$user,$passwd,$dbname);