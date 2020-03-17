<?php
    include 'header.php';
    // 分页
    
    // 获取页码
    $current = (!empty($_GET['page']) && $_GET['page']>0) ? $_GET['page'] : 1;

    $limit = 4;

    $offset = ($current-1) * $limit;   //偏移量

    $size = 5;      //分页样式显示的页码个数

    if(isset($_GET['ban_type']) && !empty($_GET['ban_type']) && $_GET['ban_type'] >0){
        $bantype = $_GET['ban_type'];
        // pre($bantype);          
        // die;
      // 查询记录总数
      $con = "WHERE ban_type = {$bantype}";
      $count_arr = select_one('banner','COUNT(*) AS `count`',$con);
      $count = $count_arr['count'];


	    $condition = "INNER JOIN `nnd_bantype` AS type ON nnd_banner.ban_type=type.ban_type_id  WHERE ban_type = {$bantype} LIMIT {$offset},{$limit}";
	    $banner = select_all('banner','*',$condition);
    }else{
      //查询总记录数
      $count_arr = select_one('banner','COUNT(*) AS `count`');
      $count = $count_arr['count'];
      $condition = "INNER JOIN `nnd_bantype` AS type ON nnd_banner.ban_type=type.ban_type_id LIMIT {$offset},{$limit}   ";
      $banner = select_all('banner','*',$condition);
      
    }
    //    pre($banner);
    //    die;

    $url = get_url();
    // pre($url);
    // die;
    //单个删除
    if(isset($_GET['del']) && $_GET['del']>0){
      $id= $_GET['del'];

      if(isset($_GET['bantype'])){
        $bantype= "?bantype=".$_GET['bantype'];
      }else{
        $bantype="";
      }
       
      $res = del('nnd_banner',"WHERE ban_id= {$id}");
      if($res['code'] == 1){
        echo "<script> alert('删除成功');window.location.href='{$current_url}{$bantype}'</script> ";
        die;
      }else{
        echo "<script> alert('删除失败')</script> ";
      }
    }

    //批量删除
    if(isset($_POST['idarr'])){
      $id_str = rtrim(implode($_POST['idarr'],','),',');
      // pre($id_str);die;
      $condition = "WHERE ban_id IN ({$id_str})";

      $res = del('nnd_banner',$condition);
	    if($res['code']==1){
		    echo "<script>alert('删除成功!');window.location.href='{$current_url}?bantype={$bantype}';</script>";
		    die;
	    }else{
		    echo "<script>alert('删除失败!');</script>";
	    }
    }


    
?>


  <!-- Start: Content -->
  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">广告图管理</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">广告图列表</div>
                  <a href="ban_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加文章</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <h2 class="panel-body-title">互联网</h2>
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                          <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                          <th width="200">名字</th>
                          <!-- <th width="300">内容</th> -->
                          <th>缩略图</th>
                          <th>分类</th>
                          <!-- <th>添加时间</th> -->
                          <th width="200">操作</th>
                      </tr>
                      <?php foreach($banner as $item){ ?>
                      <tr class="success">
                        <td class="text-center"><input type="checkbox" value="<?php echo $item['ban_id']; ?>" name="idarr[]" class="cbox"></td>
                        <td><?php echo $item['ban_name']; ?></td>
                        <!-- <td><?//php echo mb_substr($item['ban_content'],0,50); ?>...</td> -->
                        <td>
                            <img src="<?php echo $item['ban_url']; ?>" width="150px" alt="">
                        </td>
                        <td><?php echo $item['ban_type_name']; ?></td>
                        <!-- <td><//?php echo date("Y/m/d H:i",$item['ban_time']); ?></td> -->
                        <td>
		                      <div class="btn-group">
		                        <a href="ban_edit.php?edit=<?php echo $item['ban_id']; ?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                            <a onclick="return confirm('确定要删除吗？');" 
                              
                                href="<?php echo $url.'del='.$item['ban_id'] ;?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
		                      </div>
                        
                        </td>
                      </tr>
	                  <?php }?>
                      <!--<tr class="success">
                        <td class="text-center"><input type="checkbox" value="1" name="idarr[]" class="cbox"></td>
                        <td>再谈互联网给传统金融带来的颠覆</td>
                        <td>2015-01-10</td>
                        <td>
                          <div class="btn-group">
                            <a href="article_edit.html" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                            <a onclick="return confirm('确定要删除吗？');" href="#" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                          </div>
                        
                        </td>
                      </tr>-->
                  </table>
                  
                  <div class="pull-left">
                  	<button type="submit" class="btn btn-default btn-gradient pull-right delall"><span class="glyphicons glyphicon-trash"></span></button>
                  </div>
                  
                  <div class="pull-right">
                    <!--<ul class="pagination" id="paginator-example">
                      <li><a href="#">&lt;</a></li>
                      <li><a href="#">&lt;&lt;</a></li>
                      <li><a href="#">1</a></li>
                      <li class="active"><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">&gt;</a></li>
                      <li><a href="#">&gt;&gt;</a></li>
                    </ul>-->
                      <?php echo page($current,$count,$limit,$size,$class='pagination'); ?>
                  </div>
                  
                </div>
                </form>
              </div>
          </div>
        </div>




        
    </div>
  </section>
  <!-- End: Content --> 
</div>
<!-- End: Main --> 
</body>
</html>


