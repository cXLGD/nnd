<?php

include 'header.php';
// include 'banner.php';
// pre($banner);


//获取当前url
$current_url = basename($_SERVER['REQUEST_URI']);
$id = empty($_GET['cases_id']) ? $_GET['info_id'] : $_GET['cases_id'];
$table = empty($_GET['cases_id']) ? 'nnd_info' : 'nnd_cases';
$cond = empty($_GET['cases_id']) ? 'info_id' : 'case_id';
// pre($conn);

$sql = "SELECT * FROM {$table} WHERE {$cond} = {$id}";
$case_info = mysqli_query($conn, $sql);
$res = mysqli_fetch_array($case_info);

// pre($res);


//内容
// $solution = select_all('service');
// pre($solution);

include 'views/show_info.html';
include 'footer.php';
