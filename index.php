<?php
	include 'header.php';
	//返回 $banner['ban_type'] =1 ||$ban_type['ban_type_id'] =1
	include 'banner.php';
	// pre($banner);

	//服务
	$condition = 'LIMIT 6';
	$serv_type = select_all('serv_type','*',$condition);

	// 案例
	$case_cond = "ORDER BY case_id DESC LIMIT 6";
	$cases = select_all('cases','case_id,case_img',$case_cond);
	// pre($cases);




	include './views/index.html';
	include 'footer.php';

	
