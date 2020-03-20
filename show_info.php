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
// 上一页
$prev_sql = "SELECT `case_id` FROM nnd_cases WHERE case_id < {$id} ORDER BY case_id DESC LIMIT 1";
$prev_info = mysqli_query($conn, $prev_sql);
$prev_res = mysqli_fetch_array($prev_info);
$prev = $prev_res ? $prev_res : '';

// 下一页
$next_sql = "SELECT `case_id` FROM nnd_cases WHERE case_id > {$id} ORDER BY case_id ASC LIMIT 1";
$next_info = mysqli_query($conn, $next_sql);
$next_res = mysqli_fetch_array($next_info);
$next = $next_res ? $next_res : '';

// pre($prev);die;
//内容
// $solution = select_all('service');
// pre($solution);

include 'views/show_info.html';
include 'footer.php';
