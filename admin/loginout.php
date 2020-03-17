<?php
    
    if(!(isset($_COOKIE['isLogin']) && $_COOKIE['isLogin']==1)){
		
		echo '您还未登录,请登录！';
		echo '<script>
					setTimeout(()=>{
    					window.location.href="login.php";
    				},1000);
    		 </script>';
        exit;
    }

	$user = $_COOKIE['username'];
	$time = time();


	setcookie('username','',time()-1,'/');
	setcookie('passwd','',time()-1,'/');

	//删除登录状态
	setcookie('isLogin','',time()-1,'/');

	echo '<script>alert("再见->' .$user.'");</script>';

	echo '<script>setTimeout(()=>{window.location.href="login.php";},1000);</script>';