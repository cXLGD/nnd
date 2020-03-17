<?php

	//连接数据库函数
	function db_connct($host,$user,$passwd,$dbname){
		global $conn;
		$conn = mysqli_connect($host,$user,$passwd,$dbname);

		if(!$conn){
			die('数据库连接失败!<br />'.mysqli_connect_error());
		}

		mysqli_set_charset($conn,'utf8');

		return $conn;
	}

	/**
	 * 查询多条记录 select_all()
	 * @param $table
	 * @param $ele
	 * @return array
	 */
	function select_all($table,$ele='*',$condition=''){
		global $conn;
		$sql = "SELECT {$ele} FROM nnd_{$table} {$condition}"; 
		// pre($sql);

		$info = mysqli_query($conn,$sql);
		if($info && mysqli_num_rows($info)>0 ){
			while ($res = mysqli_fetch_array($info)){
				$res_arr[] = $res;
			}
		}
		return isset($res_arr) ? $res_arr : '无记录!';
	}

	/**
	 * 查询一条记录
	 * @param $table                表名
	 * @param $ele                  查找的元素(字段)
	 * @param string $condition     条件语句
	 * @return array|null           结果集
	 */
	function select_one($table,$ele='*',$condition=''){
		global $conn;
		$sql = "SELECT {$ele} FROM nnd_{$table} {$condition}";
		$res = mysqli_query($conn,$sql);
		return mysqli_fetch_array($res);
	}


	/**
	 * @param $table        数据表名
	 * @param $upload_arr   添加内容数组
	 * @return mixed        添加成功/失败的状态码
	 */





	/**
	 * @return string
	 */
	function get_url(){
		$url = $_SERVER['PHP_SELF'].'?';
		// pre($url);	
		if($_GET){
			foreach ($_GET as $k => $v){
				if($k != 'page'){
					$url = $url . "{$k}={$v}&";
				}
			}
		}
		// pre($url);
		return $url;
	}


	/*
	    [1]   2   3   4   5     cur=1
		 1   [2]  3   4   5     cur=2
		 1   2   [3]  4   5     cur=3
		 2   3   [4]  5   6     cur=4
		 3   4   [5]  6   7     cur=5
		 4   5   [6]  7   8     cur=6
		 5   6   [7]  8   9     cur=7
		 5   6    7  [8]  9     cur=8
		 5   6    7   8  [9]    cur=9
	 */

	/**
	 * @param integer $current       当前页码
	 * @param integer $count         总数据记录
	 * @param integer $limit         每页显示条数
	 * @param integer $size          页码数量
	 * @param string  $class
	 * @return string                分页html字符串
	 */
	function page($current,$count,$limit,$size,$class='mypage'){
		$str = "";
		$url= get_url();
		if($count > $limit){ //如果数据条数大于每页限制显示的条数，则分页
			$str .= "<ul class='{$class}'>";   //ul样式													

			$pages = ceil($count/$limit);// 页码总数

			//首页
			if($current==1){
				$str .= "<li class='prev'><a>&lt;</a></li>";
			}else{ //上一页
				$str .= "<li ><a href='{$url}page=1'>首页</a></li>";
				$str .= "<li class='prev'>
							<a href='{$url}page=".($current-1)."'>&lt;</a>
						</li>";
			}

			// 如果当前页小于 页码数/2 向下取整的值，则分页从1开始
			if($current <= floor($size/2)){
				$start = 1;
				$end = $pages > $size ? $size : $pages;
			}else if($current > $pages - floor($size/2)){
				//如果当前页码大于总页码减去规定页码的一半
				//如：$current(8|9) > $pages - floor(size/2) = 9 - floor(5/2) = 7
				$start = ($pages - $size + 1 < 1) ? 1 : $pages - $size + 1; //避免小于0的情况出现
				$end = $pages;
			}else{
				$start = $current - floor($size/2);
				$end = $current + floor($size/2);
			}

			//循环输出页码数
			for($i=$start;$i<=$end;$i++){
				if($i == $current){
					$str .= "<li class='active'><a>{$i}</a></li>";
				}else{
					$str .= "<li><a href='?page={$i}'>{$i}</a></li>";
				}
			}

			//尾页
			if($current == $pages){
				$str .= "<li class='next'>&gt;</li>";
			}else{ //下一页
				$str .= "<li class='next'>
							<a href='{$url}page=".($current+1)."'>&gt;</a>
						 </li>";
				$str .= "<li ><a href='{$url}page={$pages}'>尾页</a></li>";
			}

			$str .= "</ul>";
		}
		return $str;
	}

	/**
	 * 添加、插入
	 * @param $table        数据表名
	 * @param $upload_arr   添加内容数组
	 * @return mixed        添加成功/失败的状态码
     *	$sql = "INSERT INTO `nnd_info` (`info_title`,`info_content`,`info_img`,`info_time`,`info_type`) VALUES ('$title','$content','$img','$time',$type)";
	 */
	function insert($table,$arr){
		global $conn;
		$key = "";
		$value = "";
		foreach($arr as $k => $v){
			$key .= "`$k`,";
			$value .= "'$v',";
		}	
		$key = rtrim($key,',');
		$value = rtrim($value,',');

		$sql = "INSERT INTO $table ($key) VALUES ($value)";
		// echo $sql;
		// exit;
		$res = mysqli_query($conn,$sql);

		if($res){
			$insert['code'] = 1;
		}else{
			$insert['code'] = 0;
		}
		return $insert;
	}


	/**
	 * 更新
	 * @param $table
	 * @param $arr
	 * @param $conditon
	 * @return mixed
	 */
	function update($table,$arr,$condition){
		global $conn;
		$str = "";
		foreach($arr as $k => $v){
			$str .= "`{$k}`='{$v}',";
		}
		// pre( $str);

		$str = rtrim($str,',');
		// pre( $str);

		$sql = "UPDATE {$table} SET {$str} {$condition}";
		pre( $sql);
		// die;
		$res = mysqli_query($conn,$sql);
		// pre($res);
		// die;
		
		if($res){
			$update['code'] =1;
		}else{
			$update['code'] =0;
		}
		return $update;
	}




	/**
	 * 删除
	 * @param $table
	 * @param $condition
	 * @return mixed
	 */
	function del($table,$condition){
		global $conn;
		$sql = "DELETE FROM {$table} {$condition}";
		$res = mysqli_query($conn,$sql);
		if($res){
			$del['code'] = 1;
		}else{
			$del['code'] = 0;
		}
		return $del;
	}



	function upload($name,$file_dir='uploads'){

		$up_info = array();//上传信息返回的数组

		// 1. 判断错误信息
		if($_FILES[$name]['error'] > 0){
			switch($_FILES[$name]['error']){
				case 1:
					$up_info['msg'] = "文件大小超出了 upload_max_filesize 的值";
					break;
				case 2:
					$up_info['msg'] = "上传的文件大小超出了MAX_FILE_SIZE指令的值";
					break;
				case 3:
					$up_info['msg'] = "如果文件没有完全上传";
					break;
				case 4:
					$up_info['msg'] = "没有指定上传文件";
					break;
				default:
					$up_info['msg'] = "未知错误";
			}
			return $up_info;
		}

		//指定上传目录
		$uploads = $file_dir;
		if(!is_dir($uploads)){
			mkdir($uploads,755,TRUE);
		}

		// 获取文件类型
		$type = explode('/', $_FILES[$name]['type']); // image/jpeg
		// 获取文件后缀
		$suffix = array_pop($type);
		// 允许上传的数据类型
		$allows = array('jpeg','jpg','png','gif','psd');
		//判断上传的文件类型
		if(!in_array($suffix,$allows)){ //in_array检查数组中是否存在某个值
			$up_info['msg'] = "不允许上传 {$suffix} 文件类型";
		}

		// 指定文件名
		$new_name = date("YmdHis").mt_rand(100,999).'.'.$suffix;
		$path = $uploads.'/'.$new_name;

		if(move_uploaded_file($_FILES[$name]['tmp_name'], $path)){
			$up_info['path'] = $path;
			$up_info['code'] = 1;
			$up_info['msg'] = '上传成功';
			// pre($up_info);
			// die;
			$up_info['filename'] = $new_name;

		}else{
			$up_info['code'] = 0;
			$up_info['msg' ] = "图片上传失败!";
		}
		return $up_info;
	}



	/**
	 * 缩略图
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
		//变量函数
		$desc_str = "imagecreatefrom".$types[$type];
		//原图
		$desc_img = $desc_str($img_addr);
		//3. 新建一个真彩色图像，参数（缩略图的宽，高）
		$img_new = imagecreatetruecolor($width,$hight);

		//imagecolorallocate 为一幅图像分配颜色
		$white = imagecolorallocate($img_new,255,255,255);
		//imagecolorallocate 为一幅图像分配颜色 + alpha(透明度)
		//$white = imagecolorallocatealpha($img_new,255,255,255,100);

		//区域填充
		imagefill($img_new,0,0,$white);
		//4. 拷贝部分图像并调整大小
		imagecopyresized($img_new,$desc_img,0,0,0,0,$width,$hight,$w,$h);


		//获取后缀
		$suffix = $types[$type];

//		header("Content-Type:image/{$suffix}");

		$filename = 'thumb_'.$filename;

		$thumb = $path.'/'.$filename;

		$save = "image".$types[$type];
		$save($img_new,$thumb); //保存
		//$save($img_new); //输出

		//8. 释放内存
		imagedestroy($img_new);

		return $thumb;
	}


	/**
	 * 文字水印 			
	 * @param $img_addr				[原图路径]
	 * @param string $string		[要添加的文字]
	 * @param string $filename		[原图文件名]
	 */
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
		//随机位置
		$x = mt_rand(50,$width - strlen($string)*50);
		$y = mt_rand(50,$height - 50);

		// php5 imagettftext
		imagettftext($img,50,0,$x,$y,$red,'./fonts/STXINGKA.TTF',$string);
		imagettftext($img,50,0,$x+1,$y+1,$blue,'./fonts/STXINGKA.TTF',$string);
		imagettftext($img,50,0,$x+2,$y+3,$white,'./fonts/STXINGKA.TTF',$string);

		// php7 imagefttext 使用 FreeType 2 字体将文本写入图像

		//保存/输出图片
		header("Content-Type:image/{$types[$type]}");
		$save = "image".$types[$type];

		// $save($img,'img/aaa.'.$types[$type]);
		if($filename === ''){
			$filename = date("YmdHis").'.'.$types[$type];
		}

		$save($img,'img/'.$filename);
		$save($img);

		//释放资源
		imagedestroy($img);
	}

	/**
	 * 图片水印
	 * @param $origin_img		[原图片]
	 * @param $water_img		[水印图片]
	 * @param string $path		[路径]
	 */
	function watermark_img($origin_img,$water_img,$path=''){

		list($ori_width,$ori_height,$ori_type) = getimagesize($origin_img);
		list($w_width,$w_height,$w_type) = getimagesize($water_img);

		$types = array(
			1 => 'gif',
			2 => 'jpeg',
			3 => 'png'
		);

		//函数变量
		$origincreate = "imagecreatefrom".$types[$ori_type];//原图片
		$watercreate = "imagecreatefrom".$types[$w_type];//水印图片

		$img_src = $origincreate($origin_img);//原图片
		$img_des = $watercreate($water_img);//水印图片

		//随机位置(不能超出原图位置)
		//$x = mt_rand(4,$ori_width - $w_width);
		//$y = mt_rand(4,$ori_height - $w_height);

		//固定位置
		$x = 10;
		$y = $ori_height - $w_height - 10;

		//imagecopy — 拷贝图像的一部分
		imagecopy($img_src,$img_des,$x,$y,0,0,$w_width,$w_height);

		//输出
		header("Content-Type:image/{$types[$ori_type]}");
		$save = "image".$types[$ori_type];

		if($path === ''){
			$path = './';
		}
		$save($img_src,$path.date("YmdHis").'.'.$types[$ori_type]);
		$save($img_src);

		//释放资源
		imagedestroy($img_src);
		imagedestroy($img_des);
	}



	





	//print_r打印
	function pre($arr){
		echo '<pre>';
		print_r($arr);
		echo '</pre>';
	}
	//var_dump打印
	function dump($arr){
		echo '<pre>';
		var_dump($arr);
		echo '</pre>';
	}










