<?php
    session_start();
	include 'includes/conf.php';
    
       
     // pre($_POST);
     if(isset($_POST['reg'])){
         $user = $_POST['username'];
         $condition = "WHERE admin_name = '{$user}'";
         $admin = select_one('admin','admin_name',$condition);

         $upload_arr = array();
         $upload_arr['admin_name'] = $_POST['username'];
         $upload_arr['admin_password'] = md5($_POST['password']);
         $upload_arr['admin_reg_time'] = time();
         // pre($upload_arr);
         
         // pre($res);
         // die;
        
        //  pre($admin);
        //  die;

        if($admin['admin_name'] == $_POST['username']){
            echo "<script>alert('用户名已存在！');window.history.go(-1);</script>";
            die;
        }else{
            $res = insert('nnd_admin',$upload_arr);
            if($res['code']==1){
                echo "<script>alert('注册成功！');window.location.href='login.php';</script>";
                die;
            }else{
                echo "<script>alert('注册失败！');</script>";
            }
        }
      
    
        
    }
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

</head>

<body class="login-page">

<!-- Start: Main -->
<div id="main">
  <div class="container">
    <div class="row">
      <div id="page-logo"></div>
    </div>
    <div class="row">
      <div class="panel">
        <div class="panel-heading">
          <div class="panel-title">注 册</div>
		</div>
        <form action="login_reg.php" class="cmxform" id="altForm" method="post">
			<div class="panel-body">
				<div class="form-group">
					<div class="input-group"> <span class="input-group-addon">用户名</span>
						<input type="text" name="username" class="form-control phone" maxlength="10" autocomplete="off" placeholder="" required>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group"> <span class="input-group-addon">密&nbsp;&nbsp;&nbsp;码</span>
						<input type="password" name="password" class="form-control product" maxlength="10" autocomplete="off" placeholder="" required>
					</div>
				</div>
				
			</div>
          <div class="panel-footer"> <span class="panel-title-sm pull-left" style="padding-top: 7px;"></span>
            <div class="form-group margin-bottom-none">
			  <a class="" href="login.php" name="login">返回登录</a>				
			  <input class="btn btn-primary pull-right" style="margin-right:10px;" type="submit" name="reg" value="注 册" />
              <div class="clearfix"></div>
            </div>
		  </div>
		  
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End: Main --> 

<!-- Core Javascript - via CDN --> 
<script src="js/jquery.min.js"></script> 
<script src="js/jquery-ui.min.js"></script> 
<script src="js/bootstrap.min.js"></script> <!-- Theme Javascript --> 
<script type="text/javascript" src="js/uniform.min.js"></script> 
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/custom.js"></script> 
<script type="text/javascript">

jQuery(document).ready(function() {

	// Init Theme Core 	  
	Core.init();   
	
});

</script>
</body>

</html>
