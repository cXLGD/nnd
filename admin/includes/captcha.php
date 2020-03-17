<?php
	//随机数
	function random_str(){
		$str = "abcdefghigklmnopqrstuvwxyz1234567890";

		$reg = '/[a-z]{1}/';

		$len = strlen($str);
		for($i=0;$i<$len-1;$i++){
			if(preg_match($reg,$str)){
				$i = rand(0,$len-1);
				$str[$i] = strtoupper($str[$i]);
			}
		}
		$shuffle = str_shuffle($str); //随机打乱一个字符串
		$new_str = substr($shuffle,0,4);
		return $new_str;
	}

	//echo random_str();
	//captcha 验证码


	$width = 150;
	$height = 50;
	// 1.创建真彩图片
	$img = imagecreatetruecolor($width,$height);

	// 2.颜色
	$white = imagecolorallocate($img,255,255,255);



	// 3. 在制定图片画矩形
	imagefilledrectangle($img,0,0,$width,$height,$white);

	//5,将随机数写入到这个图片里面去 imagestring()
	$str = random_str();
	$fontsize = 30;
	for($i=0;$i<strlen($str);$i++){

		$color = imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));

		//定义字符Y坐标
		$y= ($height+15)/2 + rand(-1,1);

		//定义字符X坐标
		$x = $i*30+8;

		imagettftext($img,$fontsize,rand(-30,30),$x,$y,$color,realpath('./FZSTK.TTF'),$str[$i]);
	}

	//	imagestring($img,7,0,0,$str,$textcolor);
	//imagettftext($img,'20',rand(-30,30),imagefontwidth(20),imagefontheight(20),$textcolor,'./texb.ttf',$str);



	//6. 防止别人去恶意刷我们的验证码 可以在这个图片上面加上一些点 imagesetpixel()
	for($i=0;$i<50;$i++){
		$potcolor = imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
		//imagesetpixel($img,rand(0,$width),rand(0,$height),$potcolor);
		//原点
		imagefilledellipse($img,rand(0,$width),rand(0,$height),rand(1,3),rand(1,3),$potcolor);

	}

	//7.划线
	for($i=0;$i<5;$i++) {
		$linecolor = imagecolorallocate($img, rand(0, 255), rand(0, 255), rand(0, 255));

		imageline($img,rand(0,$width),rand(0,$height),rand($width,$width),rand(0,$height),$linecolor);
	}


	//开启会话控制
	session_start();
	$_SESSION['captcha' ] = strtolower($str); //转小写


	//输出
	header("Content-Type:image/jpeg");
	imagejpeg($img);

	//销毁
    imagedestroy($img);
    echo '1234';