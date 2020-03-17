<?php

include 'header.php';
// include 'banner.php';
// pre($banner);


    //获取当前url
    $current_url = basename($_SERVER['REQUEST_URI']);
if($current_url == 'solution.php') {
    $sql = "SELECT * FROM nnd_banner WHERE ban_type=2";
    $ban_info = mysqli_query($conn,$sql);
    while($res = mysqli_fetch_assoc($ban_info)){
        $banner[]= $res;
    }
}

//内容
$solution = select_all('service');
// pre($solution);

include 'views/solution.html';
include 'footer.php';