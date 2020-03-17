<?php
	include 'header.php';
	//返回 $banner['ban_type'] =1 ||$ban_type['ban_type_id'] =1
	include 'banner.php';
	// pre($banner);
	


	//服务
	$condition = 'LIMIT 6';
	$serv_type = select_all('serv_type','*',$condition);
	// pre($serv_type);




	include './views/index.html';
	include 'footer.php';

	
