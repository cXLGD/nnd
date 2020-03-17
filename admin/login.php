<?php
	session_start();
	include './includes/conf.php';
	

	if(isset($_COOKIE['isLogin']) && $_COOKIE['isLogin']==1){
		echo '您已经登录！';
		echo '<script>setTimeout(()=>{window.location.href="index.php";},1000)</script>';
		die;
		//return;
	}


	$dbms='mysql';     //数据库类型
	$host='localhost'; //数据库主机名
	$dbName='nndou';    //使用的数据库
	$dbuser='root';      //数据库连接用户名
	$dbpass= '';          //对应的密码
	$dsn="$dbms:host=$host;dbname=$dbName";

	if(isset($_POST['login'])){

		$user = trim($_POST['user']);
		$pwd = md5($_POST['passwd']);
		$captcha = trim(strtolower($_POST['captcha']));   
		// print_r($user);
		// print_r($pwd);

		$db = new PDO($dsn,$dbuser,$dbpass); //初始化一个PDO对象

		$sql = "SELECT admin_id,admin_name,admin_last_login FROM `nnd_admin` WHERE admin_name = :username AND admin_password = :pwd";
		// echo($sql);die;
		$info = $db->prepare($sql);  //PDO::prepare — 备要执行的SQL语句并返回一个 PDOStatement 对象
		// print_r($info);

		$info->execute([':username'=>$user,':pwd'=>$pwd]);  //PDOStatement::execute — 执行一条预处理语句
		
		if($info->rowCount() > 0){   //PDOStatement::rowCount — 返回受上一个 SQL 语句影响的行数
            list($id,$user,$lastlogin) = $info->fetch(PDO::FETCH_NUM);
			
            setcookie('ID',$id,time()+60*10,'/');
            setcookie('username',$user,time()+60*10,'/');
			setcookie('lastlogin',date("Y-m-d H:i:s",$lastlogin),time()+60*10,'/');
			// echo $_COOKIE['lastlogin'];
			// die;		
			//验证用户、密码、验证码
			if($user === ''){
				echo "<script>alert('用户名不能为空');window.history.go(-1);</script>";
				return;
			}
			if($pwd === ''){
				echo "<script>alert('密码不能为空!');window.history.go(-1);</script>";
				return;
			}
			if($captcha  === '' || $captcha != $_SESSION['captcha']){
				echo "<script>alert('验证码错误');window.history.go(-1);</script>";
          		return;
			}
			
			// pre($_SESSION);
			// die;
            //登录状态
            setcookie('isLogin',1,time()+60*10,'/');
            echo '<script> alert("欢迎你");   </script>';

            header("refresh:1,http://www.nndou.com/admin");
            exit;

        }else{
            echo '<script> alert("登录失败");   </script>';
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
          <div class="panel-title">CMS内容管理系统</div>
		</div>
        <form action="login.php" class="cmxform" id="altForm" method="post">
			<div class="panel-body">
				<div class="form-group">
					<div class="input-group"> <span class="input-group-addon">用户名</span>
						<input type="text" name="user" class="form-control phone" maxlength="10" autocomplete="off" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group"> <span class="input-group-addon">密&nbsp;&nbsp;&nbsp;码</span>
						<input type="password" name="passwd" class="form-control product" maxlength="10" autocomplete="off" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">验证码</span>
						<input type="text" name="captcha" class="form-control" style="width: 60%;" />
						<img src="./includes/captcha.php" id="captcha"  style="width: 39%;height: 34px;border: 1px solid #ccc;margin-left: 1%;border-top-right-radius: 4px;border-bottom-right-radius: 4px;" alt="" id="captcha">
					</div>
            	</div>
			</div>
          <div class="panel-footer"> <span class="panel-title-sm pull-left" style="padding-top: 7px;"></span>
            <div class="form-group margin-bottom-none">
			  <a class="" href="login_reg.php" name="reg">注 册</a>				
			  <input class="btn btn-primary pull-right"  style="margin-right:10px;" type="submit" name="login" value="登 录" />
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

	//点击更换验证码
	$("#captcha").click(function(){
		$(this).prop('src',"./includes/captcha.php?"+Math.random());
	})
	
});

</script>
</body>

</html>
