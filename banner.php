<?php
    // 轮播图控制页面

    //不能直接访问 banner.php
    $current_url = basename($_SERVER['REQUEST_URI']);
    if($current_url == 'banner.php') {
        die('Permission denied!');
    }
    // 轮播图信息查询
	// $sql = "SELECT * FROM nnd_banner";
	// $ban_info = mysqli_query($conn,$sql);
	// while($res = mysqli_fetch_assoc($ban_info)){
	// 	$banner[]= $res;
	// }
    // pre($banner);

    
    

    //获取当前url
    $current_url = basename($_SERVER['REQUEST_URI']);
    // pre($current_url);

	if($current_url == 'index.php' || $current_url == '') {
		$sql = "SELECT * FROM nnd_banner WHERE ban_type=1";
        $ban_info = mysqli_query($conn,$sql);
        while($res = mysqli_fetch_assoc($ban_info)){
            $banner[]= $res;
        }
    }

    // pre($current);
    if($current_url == 'news_center.php' || $current_url == 'news_center.php?page=1' || $current_url == 'news_center.php?page=2'
    || $current_url == 'news_center.php?page=3'|| $current_url == 'news_center.php?page=4'|| $current_url == 'news_center.php?page=5') {
		$sql = "SELECT * FROM nnd_banner WHERE ban_type=3";
        $ban_info = mysqli_query($conn,$sql);
        while($res = mysqli_fetch_assoc($ban_info)){
            $banner[]= $res;
        }
    }
    if($current_url == 'cases.php' ||$current_url =='cases.php?type=1'||$current_url =='cases.php?type=2'||$current_url =='cases.php?type=3') {
		$sql = "SELECT * FROM nnd_banner WHERE ban_type=4";
        $ban_info = mysqli_query($conn,$sql);
        while($res = mysqli_fetch_assoc($ban_info)){
            $banner[]= $res;
        }
    }
    if($current_url == 'about.php') {
		$sql = "SELECT * FROM nnd_banner WHERE ban_type=5";
        $ban_info = mysqli_query($conn,$sql);
        while($res = mysqli_fetch_assoc($ban_info)){
            $banner[]= $res;
        }
	}

pre($banner);



    include 'views/banner.html';


