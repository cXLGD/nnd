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
		$info = mysqli_query($conn,$sql);
		while ($result = mysqli_fetch_array($info)){
			$res_arr[] = $result;
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
		$sql = "SELECT {$ele} FROM nnd_{$table} {$condition} ";
		$res = mysqli_query($conn,$sql);
		return mysqli_fetch_array($res);
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
	function page($current,$count,$limit,$size,$class="mypage"){
		$str = "";
		if($count > $limit){	//如果数据条数大于每页限制显示的条数，则分页
			$str .= "<div class='{$class}'><ul>";

    		$pages = ceil($count / $limit);     //计算总页数

			//首页
			if($current == 1){
				$str .="<li class='prev'>&lt;</li>";
			}else{	//上一页
				$str .= "<li class='prev'>
							<a href='?page=".($current-1)."'>&lt;</a>
						</li>";
				// $str .= " <li> <a href=''> 1 </a> </li>";
			}

			// 如果当前页小于 页码数/2 向下取整的值，则分页从1开始
			if($current <= floor($size/2)){
				$start = 1;		//开始的页
				$end = $pages > $size ? $size : $pages;
				// $end = $size;	//结束的页 
			}else if($current > $pages - floor($size/2)){
				//如果当前页码大于总页码减去规定页码的一半
				//如：$current(8|9) > $pages - floor(size/2) = 9 - floor(5/2) = 7
				$start = ($pages - $size + 1<1) ? 1 : $pages - $size + 1;//避免小于0的情况出现
				$end = $pages;
			}else{
				$start = $current - floor($size/2);
				$end = $current + floor($size/2);
			}
			


			//循环输出页码数
			for($i=$start;$i<=$end;$i++){
				if($i == $current){
					$str .= " <li class='active'><a> {$i} </a></li>";
				}else{
					$str .= " <li><a href='?page={$i}'> {$i} </a></li>";
				}
			}
			// print_r($current);

			//尾页
			if($current == $pages){
				$str .="<li class='next'>&gt;</li>";
			}else{		//下一页
				$str .= "<li class='next'>
							<a href='?page=".($current+1)."'>&gt;</a>
						</li>";
			}

			$str .= "</div></ul>";
		}
		return $str;
		
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