<?php

function watermark($img_addr,$string=''){
    list($width,$height,$type)= getimagesize($img_addr);
    var_dump($width);
    $types = array(
        1 => 'gif',
        2 => 'jpeg',
        3 => 'png'
    );

    $createimg = "imagecreatefrom".$types[$type];
    // 原图
    $img = $createimg($img_addr);

    $red = imagecolorallocate ($img,255,0,0);
    header("Content-Type:image/{$types[$type]}");
    imageline($img,0,0,200,200,$red);
    $sava = "image".$types[$type];

    $sava($img);
    // $sava($img,'12331.png');
    

    imagedestroy($img);

}

echo watermark('banner1.png');

