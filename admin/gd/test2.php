<?php
    /**
	 * @param $img_addr         [原图路径]
	 * @param $width            [缩略图宽度]
	 * @param $hight            [缩略图高度]
	 * @param string $path      [存储目录]
	 * @param string $filename  [原图文件名]
	 * @return string           [缩略图路径]
	 */
	function thumb($img_addr,$width,$hight,$path='',$filename=''){
		list($w,$h,$type) = getimagesize($img_addr);

		$types = array(
			1 => 'gif',
			2 => 'jpeg',
			3 => 'png'
		);
		$desc_str = "imagecreatefrom".$types[$type];
		$desc_img = $desc_str($img_addr);

		$img_new = imagecreatetruecolor($width,$hight);

		//imagecolorallocate 为一幅图像分配颜色
		$white = imagecolorallocate($img_new,255,255,255);
		//imagecolorallocate 为一幅图像分配颜色 + alpha(透明度)
		//$white = imagecolorallocatealpha($img_new,255,255,255,100);
		imagefill($img_new,0,0,$white);

		imagecopyresized($img_new,$desc_img,0,0,0,0,$width,$hight,$w,$h);


		//后缀
		$suffix = $types[$type];

		header("Content-Type:image/{$suffix}");

		$filename = 'thumb_'.$filename;

		$thumb = $path.'/'.$filename.'.'.$suffix;

		$save = "image".$types[$type];
		$save($img_new,$thumb); //保存
		//$save($img_new); //输出

		//8. 释放内存
		imagedestroy($img_new);

        return $thumb;
        
    }


    
