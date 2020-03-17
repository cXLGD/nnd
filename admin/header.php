<?php
	session_start();
	include 'includes/conf.php';
	// 判断是否登录
	if(!(isset($_COOKIE['isLogin']) && $_COOKIE['isLogin']==1)){
		echo '<script>
					alert("您还未登录,请登录");
 			 </script>';
		echo '<script>
					setTimeout(()=>{
    					window.location.href="login.php";
    				},1000);
    		 </script>';
		exit;
	}
	
	//当前url
	$current_url = basename($_SERVER['REQUEST_URI']);
	if($current_url == '') $current_url = 'index.php';

	//正则表达式 取地址
	$reg = '/\?/';
	if(preg_match($reg,$current_url)){
		$current_url = preg_split($reg, $current_url);
		$current_url = $current_url[0];
	}
	//echo $current_url;die;


	// 资讯
	$info_type = select_all('info_type','*');
	$type = isset($_GET['info_type']) ? $_GET['info_type'] : '';

	
	// 广告图
	$ban_type = select_all('bantype','*');
	$bantype = isset($_GET['ban_type']) ? $_GET['ban_type'] : '';
	// pre($bantype);
	// die;

	// 案例
	$case_type = select_all('case_type','*');
	$casetype = isset($_GET['case_type']) ? $_GET['case_type'] : '';
	// pre($casetype);
	// die;

	//系统管理员
	$admin = select_all('admin','*');
	$admintype = isset($_GET['admin_type']) ? $_GET['admin_type'] : '';
	// pre($admintype);
	// die;

	// 资讯
	$serv_type = select_all('serv_type','*');
	$servtype = isset($_GET['serv_type']) ? $_GET['serv_type'] : '';
	
	


?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<title>CMS内容管理系统</title>
	<meta name="keywords" content="Admin">
	<meta name="description" content="Admin">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Core CSS  -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/glyphicons.min.css">

	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="css/theme.css">
	<link rel="stylesheet" type="text/css" href="css/pages.css">
	<link rel="stylesheet" type="text/css" href="css/plugins.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">

	<!-- Boxed-Layout CSS -->
	<link rel="stylesheet" type="text/css" href="css/boxed.css">

	<!-- Demonstration CSS -->
	<link rel="stylesheet" type="text/css" href="css/demo.css">

	<!-- Your Custom CSS -->
	<link rel="stylesheet" type="text/css" href="css/custom.css">

	<!-- Core Javascript - via CDN -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/uniform.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
</head>

<body>
<!-- Start: Header -->
<header class="navbar navbar-fixed-top" style="background-image: none; background-color: rgb(240, 240, 240);">
	<div class="pull-left"> <a class="navbar-brand" href="#">
			<div class="navbar-logo"><img src="images/logo.png" alt="logo"></div>
		</a> </div>
	<div class="pull-right header-btns">
		<a class="user"><span class="glyphicons glyphicon-user"></span> admin</a>
		<a href="loginout.php" class="btn btn-default btn-gradient" type="button"><span class="glyphicons glyphicon-log-out"></span> 退出</a>
	</div>
</header>
<!-- End: Header -->

<!-- Start: Main -->
<div id="main">
	<!-- Start: Sidebar -->
	<aside id="sidebar" class="affix">
		<div id="sidebar-search">
			<div class="sidebar-toggle"><span class="glyphicon glyphicon-resize-horizontal"></span></div>
		</div>
		<div id="sidebar-menu">
			<ul class="nav sidebar-nav">
				<li class="<?php if($current_url == 'index.php'){ echo 'active';} ?>">
					<a href="index.php"><span class="glyphicons glyphicon-home"></span>
                        <span class="sidebar-title">后台首页</span>
                    </a>
				</li>

				<!-- 轮播图管理 -->
				<li class="<?php if($current_url == 'ban_list.php'){ echo 'active';} ?>">
                    <a href="#sideEight" class="accordion-toggle <?php if($current_url == 'ban_list.php'){ echo 'menu-open';} ?>">
						<span class="glyphicons glyphicon-list"></span>
						<span class="sidebar-title">广告图管理</span>
						<span class="caret"></span>
                    </a>
					<ul class="nav sub-nav" id="sideEight" style="">
                        <li class="<?php if($bantype=='' && $current_url=='ban_list.php'){echo 'active';} ?>"><a href="ban_list.php"><span class="glyphicons glyphicon-record"></span> 所有广告</a></li>									
						<?php foreach($ban_type as $value){?>
						<li class="<?php if($value['ban_type_id']==$bantype){echo 'active';} ?>">	
						<a href="?ban_type=<?php echo $value['ban_type_id'];?>">
							<span class="glyphicons glyphicon-record"></span>
							<?php echo $value['ban_type_name']; ?>
						</a></li>
						<?php }?>
						
					</ul>
				</li>


				<!--服务管理 -->
				<li class="<?php if($current_url == 'serv_list.php'){ echo 'active';} ?>">
                    <a href="#sideEight" class="accordion-toggle <?php if($current_url == 'serv_list.php'){ echo 'menu-open';} ?>">
						<span class="glyphicons glyphicon-list"></span>
						<span class="sidebar-title">服务管理</span>
						<span class="caret"></span>
                    </a>
					<ul class="nav sub-nav" id="sideEight" style="">
                        <li class="<?php if($servtype=='' && $current_url=='serv_list.php'){echo 'active';} ?>"><a href="serv_list.php"><span class="glyphicons glyphicon-record"></span> 所有服务</a></li>									
						<?php foreach($serv_type as $value){?>
						<li class="<?php if($value['serv_type_id']==$servtype){echo 'active';} ?>">	
						<a href="?serv_type=<?php echo $value['serv_type_id'];?>">
							<span class="glyphicons glyphicon-record"></span>
							<?php echo $value['serv_type_name']; ?>
						</a></li>
						<?php }?>
						
					</ul>
				</li>



				<!-- 资讯管理 -->
				<li class="<?php if($current_url == 'info_list.php'){ echo 'active';} ?>">
                    <a href="#sideEight" class="accordion-toggle <?php if($current_url == 'info_list.php'){ echo 'menu-open';} ?>">
						<span class="glyphicons glyphicon-list"></span>
						<span class="sidebar-title">资讯管理</span>
						<span class="caret"></span>
                    </a>
					<ul class="nav sub-nav" id="sideEight" style="">
                        <li class="<?php if($type=='' && $current_url=='info_list.php'){echo 'active';} ?>"><a href="info_list.php"><span class="glyphicons glyphicon-record"></span> 所有资讯</a></li>
                        <?php foreach($info_type as $value){?>
						<li class="<?php if($value['info_type_id']==$type){echo 'active';} ?>">
						<a href="?info_type=<?php echo $value['info_type_id'];?>">
							<span class="glyphicons glyphicon-record"></span>
							<?php echo $value['info_type_name']; ?>
						</a></li>
						<?php }?>
						
						<!--<li>
                            <a href="#sideEight-sub" class="accordion-toggle menu-open">
                                <span class="glyphicons glyphicon-record"></span>
                                科技<span class="caret"></span>
                            </a>
							<ul class="nav sub-nav" id="sideEight-sub" style="">
                                <li><a href="article_list.html"><span class="glyphicons glyphicon-minus"></span>
                                        互联网</a>
                                </li>
                                <li><a href="#"><span class="glyphicons glyphicon-minus"></span>
                                        数码</a>
                                </li>
                                <li><a href="#"><span class="glyphicons glyphicon-minus"></span>
                                        IT</a>
                                </li>
                                <li><a href="#"><span class="glyphicons glyphicon-minus"></span>
                                        电信</a>
                                </li>
							</ul>
						</li>
						<li><a href="#"><span class="glyphicons glyphicon-record"></span> 文化</a></li>
						<li><a href="#"><span class="glyphicons glyphicon-record"></span> 生活</a></li>-->
					</ul>
				</li>



				<!-- 案例管理 -->
				<li class="<?php if($current_url == 'case_list.php'){ echo 'active';} ?>">
                    <a href="#sideEight" class="accordion-toggle <?php if($current_url == 'case_list.php'){ echo 'menu-open';} ?>">
						<span class="glyphicons glyphicon-list"></span>
						<span class="sidebar-title">案例管理</span>
						<span class="caret"></span>
                    </a>
					<ul class="nav sub-nav" id="sideEight" style="">
                        <li class="<?php if($casetype=='' && $current_url=='case_list.php'){echo 'active';} ?>"><a href="case_list.php"><span class="glyphicons glyphicon-record"></span> 所有案例</a></li>									
						<?php foreach($case_type as $value){?>
						<li class="<?php if($value['case_type_id']==$casetype){echo 'active';} ?>">	
						<a href="?case_type=<?php echo $value['case_type_id'];?>">
							<span class="glyphicons glyphicon-record"></span>
							<?php echo $value['case_type_name1']; ?>
						</a></li>
						<?php }?>
						
					</ul>
				</li>

				<!--关于牛牛豆 -->
				<li class="<?php if($current_url=='about_list.php'){echo 'active';} ?>">
                        <a href="#sideEight" class="accordion-toggle <?php if($current_url == 'about_list.php'){ echo 'menu-open';}?>">
                            <span class="glyphicons glyphicon-list"></span><span class="sidebar-title">关于牛牛豆</span><span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav" id="sideEight" style="">
                            <li class="<?php if($current_url=='about_list.php'){echo 'active';} ?>">
                                <a href="about_list.php">
                                    <span class="glyphicons glyphicon-record"></span>了解我们
                                </a>
                            </li>
                        </ul>
                    </li>

                <!-- 配置信息  -->
                    <li class="<?php if($current_url=='config_list.php'){echo 'active';} ?>">
                        <a href="#sideEight" class="accordion-toggle <?php if($current_url == 'config_list.php'){ echo 'menu-open';}?>">
                            <span class="glyphicons glyphicon-list"></span><span class="sidebar-title">配置信息</span><span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav" id="sideEight" style="">
                            <li class="<?php if($current_url=='config_list.php'){echo 'active';} ?>">
                                <a href="config_list.php">
                                    <span class="glyphicons glyphicon-record"></span>配置信息
                                </a>
                            </li>
                        </ul>
                    </li>

                




				<!-- 文章分类管理 -->
				<li>
					<a href="cate_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">文章分类管理</span></a>
				</li>

				<!-- 系统管理员 -->
				<!-- <li class="<?php //if($current_url == 'user_list.php'){ echo 'active';} ?>">
					<a href="user_list.php">
						<span class="glyphicons glyphicon-list"></span>
						<span class="sidebar-title">系统管理员</span></a>
				</li> -->
				<li class="<?php if($current_url == 'user_list.php'){ echo 'active';} ?>">
                    <a href="user_list.php" class="accordion-toggle <?php if($current_url == 'user_list.php'){ echo 'menu-open';} ?>">
						<span class="glyphicons glyphicon-list"></span>
						<span class="sidebar-title">系统管理员</span>
						<span class="caret"></span>
                    </a>
					<ul class="nav sub-nav" id="sideEight" style="">
                        <li class="<?php if($admintype=='' && $current_url=='user_list.php'){echo 'active';} ?>"><a href="user_list.php"><span class="glyphicons glyphicon-record"></span> 所有管理员</a></li>									
						<!-- <?php //foreach($admin as $value){?>
						<li class="<?php //if($value['admin_id']==$admintype){echo 'active';} ?>">	
						<a href="?admin_type=<?php //echo $value['admin_id'];?>">
							<span class="glyphicons glyphicon-record"></span>
							<?php //echo ""; ?>
						</a></li>
						<?php  //}?> -->
						
					</ul>
				</li>
				
			</ul>
		</div>
	</aside>
	<!-- End: Sidebar -->