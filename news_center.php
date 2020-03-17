<?php
    include 'header.php';
    include 'banner.php';
    // 分页
    // 查询记录总数
    $count_arr = select_one('info','COUNT(*) AS `count`');
    $count = $count_arr['count'];

    // 获取页码
    $current = (!empty($_GET['page']) && $_GET['page']>0) ? $_GET['page'] : 1;

    $limit = 5;

    $offset = ($current-1) * $limit;   //偏移量

    $size = 5;      //分页样式显示的页码个数

    // $pages = ceil($count / $limit);     //计算总页数     已在function有定义
    // echo $pages;

    $info= select_all('info','*',"ORDER BY info_id DESC LIMIT {$offset},{$limit}");
    // pre($info);
    //调用分页函数
    $page = page($current,$count,$limit,$size,"mypage");




    // include '';
    include 'views/news_center.html';
    include 'footer.php';