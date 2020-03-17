<?php

    // $img_addr = 'hahah.png';
    // //1. 先获取大图片的信息
    // $img_info = getimagesize($img_addr);
    // // var_dump($img_info);die;
    // //获取原图宽、高、类型代码
    // $width = $img_info[0];
    // $height = $img_info[1];
    // $img_type = $img_info[2];
    
    // //2. 创建一张新图片，参数(图片地址)为缩略图准备
    // if($img_type == 1){         //如果类型代码为1,则为 gif
    //     $desc_img = imagecreatefromgif($img_addr);
    // }elseif ($img_type==2){     //如果类型代码为2,则为 jpeg
	// 	$desc_img = imagecreatefromjpeg($img_addr);
	// }elseif($img_type==3){      //如果类型代码为3,则为 png
	// 	$desc_img = imagecreatefrompng($img_addr);
	// }

    // //3. 新建一个真彩色图像，参数（缩略图的宽，高）
    // $desc_w =150;
    // $desc_h =102;
    // $img_new = imagecreatetruecolor($desc_w,$desc_h);
	// echo '<pre>';
    // var_dump($img_new); //resource(5) of type (gd)
    

    
	// //4. 拷贝部分图像并调整大小
    // imagecopyresized($img_new,$desc_img,0,0,0,0,$desc_w,$desc_h,$width,$height);

	// //5. 获取后缀名

	// //6. 创建缩略图文件存放目录
	// //7. 保存图片
    // header("Content-Type:image/png");
    // // imagepng($img_new,'hahah.png');//保存
    // imagepng($img_new);//输出

    // //8
    // imagedestroy($img_new);



	$img_addr = 'hahah.png';
	//1. 先获取大图片的信息
	$img_info = getimagesize($img_addr);

	//获取原图宽、高、类型代码
	$width = $img_info[0];
	$height = $img_info[1];
	$img_type = $img_info[2];

	//2. 创建一张新图片，参数(图片地址)为缩略图准备
	if($img_type==1){ //如果类型代码为1,则为 gif
		$desc_img = imagecreatefromgif($img_addr);
	}elseif ($img_type==2){//如果类型代码为2,则为 jpeg
		$desc_img = imagecreatefromjpeg($img_addr);
	}elseif($img_type==3){//如果类型代码为3,则为 png
		$desc_img = imagecreatefrompng($img_addr);
	}


	//3. 新建一个真彩色图像，参数（缩略图的宽，高）
	$des_w = 150;
	$des_h = 102;
	$img_new = imagecreatetruecolor($des_w,$des_h);
	// echo '<pre>';
	// var_dump($img_new); //resource(5) of type (gd)

	//4. 拷贝部分图像并调整大小
	imagecopyresized($img_new,$desc_img,0,0,0,0,$des_w,$des_h,$width,$height);

	//5. 获取后缀名

	//6. 创建缩略图文件存放目录
	//7. 保存图片
	header("Content-Type:image/png");
//	imagepng($img_new,'hahah.png'); //保存
	imagepng($img_new); //输出

	//8. 释放内存
	imagedestroy($img_new);

    