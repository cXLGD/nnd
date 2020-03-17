<?php
	header('Content_Type:text/html;charset=utf-8');
	date_default_timezone_set('Asia/Shanghai');


	//加载配置文件
	include './include/conf.php';

	//导航信息查询
	$sql = "SELECT * FROM nnd_nav ";

	$nav_info = mysqli_query($conn,$sql);
	while($res = mysqli_fetch_assoc($nav_info)){
		$nav[] = $res;
	}

	//当前url
	$current_url = basename($_SERVER['REQUEST_URI']);
	if($current_url == '') {
		$current_url = 'index.php';
	}

	$reg = '/\?/';
	if(preg_match($reg,$current_url)){
		$current_url = preg_split($reg, $current_url);
		$current_url = $current_url[0];
	}
	//加载头部
	include './views/header.html';
	define('ACCESS',TRUE);
