<?php
    

//文字水印

	function watermark($img_addr,$string='',$filename=''){

		list($width,$height,$type) = getimagesize($img_addr);

		$types = array(
			1 => 'gif',
			2 => 'jpeg',
			3 => 'png'
		);

		//变量函数
		$createimg = "imagecreatefrom".$types[$type];

		//原图
		$img = $createimg($img_addr);

		// 为图像分配颜色
		$white = imagecolorallocate($img,255,255,255);
		$black = imagecolorallocate($img,0,0,0);
		$red = imagecolorallocate($img,255,0,0);
		$blue = imagecolorallocate($img,0,255,0);
		$pink = imagecolorallocate($img,255,0,255);

		//添加线条
		//imageline($img,0,0,$width,$height,$red);

		//添加文字
		//imagestring — 水平地画一行字符串
		//imagestringup — 垂直地画一行字符串

		//$x = mt_rand(4,$width - strlen($string)*imagefontwidth(7));
		//$y = mt_rand(4,$height - imagefontheight(7)+7);

		//imagestring($img,7,$x,$y,$string,$pink);

		//用 TrueType 字体向图像写入文本
		$x = mt_rand(50,$width - strlen($string)*50);
		$y = mt_rand(50,$height - 50);

		// php5 imagettftext
		imagettftext($img,50,0,$x,$y,$red,'./fonts/STXINGKA.TTF',$string);
		imagettftext($img,50,0,$x+1,$y+1,$blue,'./fonts/STXINGKA.TTF',$string);
		imagettftext($img,50,0,$x+2,$y+3,$white,'./fonts/STXINGKA.TTF',$string);

        // php7 imagefttext 使用 FreeType 2 字体将文本写入图像
        // 版本php7
        imagefttext($img,50,0,$x,$y,$red,'./fonts/STXINGKA.TTF',$string);
		imagefttext($img,50,0,$x+1,$y+1,$blue,'./fonts/STXINGKA.TTF',$string);
        imagefttext($img,50,0,$x+2,$y+3,$white,'./fonts/STXINGKA.TTF',$string);

		//保存/输出图片
		header("Content-Type:image/{$types[$type]}");
		$save = "image".$types[$type];

		// $save($img,'img/aaa.'.$types[$type]);
		if($filename === ''){
			$filename = date("YmdHis").$types[$type];
		}

		$save($img,'img/'.$filename);
		$save($img);

		//释放资源
		imagedestroy($img);
	}
