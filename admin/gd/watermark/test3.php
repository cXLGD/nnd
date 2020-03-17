<?php

function watermark_img($origin_img,$water_img,$path=''){

    list($ori_width,$ori_height,$ori_type) = getimagesize($origin_img);
    list($w_width,$w_height,$w_type) = getimagesize($water_img);

    $types = array(
        1 => 'gif',
        2 => 'jpeg',
        3 => 'png'
    );

    //变量函数
    $origincreate = "imagecreatefrom".$types[$ori_type];//原图片
    $watercreate = "imagecreatefrom".$types[$w_type];//水印图

    $img_src = $origincreate($origin_img);//原图片
    $img_des = $watercreate($water_img);//水印图

    //随机位置(不能超出原图位置)
    $x = mt_rand(4,$ori_width - $w_width);
    $y = mt_rand(4,$ori_height - $w_height);
    // $x = 10;
    // $y = $ori_height - $w_height - 10;
    
    //imagecopy — 拷贝图像的一部分
    imagecopy($img_src,$img_des,$x,$y,0,0,$w_width,$w_height);

    // 输出
    header("Content-Type:image/{$types[$ori_type]}");
    $sava = "image".$types[$ori_type];

    if($path === ''){
        $path = './';
    }
    $sava($img_src,$path.date("YmdHis").'.'.$types[$ori_type]);
    $sava($img_src);

    //释放资源
    imagedestroy($img_src);
    imagedestroy($img_des);

}
watermark_img('banner1.png','2222.jpg','img/');