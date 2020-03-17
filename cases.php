<?php

    include 'header.php';
    include 'banner.php';
	// pre($banner);

    // 查询案例分类 nnd_case_type
    $case_type = select_all('case_type','*','LIMIT 3');

    // 查询案例        
    if(!empty($_GET['type'])){   //$_GET['type'] 获取 ?type=的数
        $type = $_GET['type'];
    }else{
        $type = 1; //默认路径地址 ?type=1
    }
    pre($type);

	//通过分类查找案例  nnd_cases
    $condition = "WHERE case_type = {$type}";
    $cases = select_all('cases','*',$condition);

    include 'views/show.html';
	// include 'views/show_info.html';
    include 'footer.php';