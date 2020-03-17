<?php
  include 'header.php';
  // 分页
  
  // 获取页码
  $current = (!empty($_GET['page']) && $_GET['page']>0) ? $_GET['page'] : 1;

  $limit = 4;

  $offset = ($current-1) * $limit;   //偏移量

  $size = 5;      //分页样式显示的页码个数

  if(isset($_GET['admin_type']) && !empty($_GET['admin_type']) && $_GET['admin_type'] >0){
      $type = $_GET['admin_type'];
    // 查询记录总数
    $con = "WHERE admin_id = {$type}";
    $count_arr = select_one('admin','COUNT(*) AS `count`',$con);
    $count = $count_arr['count'];


    $condition = "WHERE admin_id LIMIT {$offset},{$limit}";
    $admin = select_all('admin','*',$condition);
    // pre($sql);
    // die;

  }else{
    //查询总记录数
    $count_arr = select_one('admin','COUNT(*) AS `count`');
    $count = $count_arr['count'];
    $condition = "WHERE admin_id LIMIT {$offset},{$limit}";
    $admin = select_all('admin','*',$condition);
    
  }
  //    pre($admin);

  $url = get_url();
  // pre($url);
  // die;
  //单个删除
  if(isset($_GET['del']) && $_GET['del']>0){
    $id= $_GET['del'];

    if(isset($_GET['admin_type'])){
      $type= "?admin_type=".$_GET['admin_type'];
    }else{
      $type="";
    }
     
    $res = del('nnd_admin',"WHERE admin_id= {$id}");
    if($res['code'] == 1){
      echo "<script> alert('删除成功');window.location.href='{$current_url}{$type}'</script> ";
      die;
    }else{
      echo "<script> alert('删除失败')</script> ";
    }
  }

  //批量删除
  if(isset($_POST['idarr'])){
    $id_str = rtrim(implode($_POST['idarr'],','),',');
    // pre($id_str);die;
    $condition = "WHERE admin_id IN ({$id_str})";

    $res = del('nnd_admin',$condition);
    if($res['code']==1){
      echo "<script>alert('删除成功!');window.location.href='{$current_url}?admin_type={$type}';</script>";
      die;
    }else{
      echo "<script>alert('删除失败!');</script>";
    }
  }

?>

  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">系统管理员</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">系统管理员</div>
                  <a href="user_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加管理员</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <!-- <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>账号</th>
                        <th>添加时间</th>
                        <th width="200">操作</th>
                      </tr>
                    	<tr class="success">
                        <td class="text-center"><input type="checkbox" value="1" name="idarr[]" class="cbox"></td>
                        <td>admin</td>
                        <td>2015-01-10</td>
                        <td>
		                      <div class="btn-group">
		                        <a href="user_edit.html" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
		                        <a onclick="return confirm('确定要删除吗？');" href="#" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
		                      </div>
                        
                        </td>
                      </tr> -->
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>账号</th>
                        <th>添加时间</th>
                        <th width="200">操作</th>
                      </tr>
                      <?php foreach($admin as $item){ ?>
                    	<tr class="success">
                        <td class="text-center"><input type="checkbox" value="<?php echo $item['admin_id']; ?>" name="idarr[]" class="cbox"></td>
                        <td><?php echo $item['admin_name']; ?></td>
                        <td><?php echo date("Y/m/d H:i",$item['admin_reg_time']); ?></td>
                        <td>
		                      <div class="btn-group">
		                        <a href="user_edit.php?edit=<?php echo $item['admin_id']; ?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                            <a onclick="return confirm('确定要删除吗？');" 
                              
                                href="<?php echo $url.'del='.$item['admin_id'] ;?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
		                      </div>
                        
                        </td>
                      </tr>  
                      <?php } ?> 
                      
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


