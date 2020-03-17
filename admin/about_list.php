<?php
  include 'header.php';
  // 分页
  
  // 获取页码
  $current = (!empty($_GET['page']) && $_GET['page']>0) ? $_GET['page'] : 1;

  $limit = 4;

  $offset = ($current-1) * $limit;   //偏移量

  $size = 5;      //分页样式显示的页码个数

  if(isset($_GET['about_type']) && !empty($_GET['about_type']) && $_GET['about_type'] >0){
      $type = $_GET['about_type'];
    // 查询记录总数
    $con = "WHERE about_id = {$type}";
    $count_arr = select_one('about','COUNT(*) AS `count`',$con);
    $count = $count_arr['count'];


    $condition = "WHERE about_id LIMIT {$offset},{$limit}";
    $about = select_all('about','*',$condition);
    // pre($sql);
    // die;

  }else{
    //查询总记录数
    $count_arr = select_one('about','COUNT(*) AS `count`');
    $count = $count_arr['count'];
    $condition = "WHERE about_id LIMIT {$offset},{$limit}";
    $about = select_all('about','*',$condition);
    
  }
  //    pre($about);

  $url = get_url();
  // pre($url);
  // die;
  //单个删除
  if(isset($_GET['del']) && $_GET['del']>0){
    $id= $_GET['del'];

    if(isset($_GET['about_type'])){
      $type= "?about_type=".$_GET['about_type'];
    }else{
      $type="";
    }
     
    $res = del('nnd_about',"WHERE about_id= {$id}");
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
    $condition = "WHERE about_id IN ({$id_str})";

    $res = del('nnd_about',$condition);
    if($res['code']==1){
      echo "<script>alert('删除成功!');window.location.href='{$current_url}?about_type={$type}';</script>";
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
      <li>
        <a href="#"><span class="glyphicon glyphicon-home"></span></a>
      </li>
      <li class="active">关于牛牛豆信息管理</li>
    </ol>
  </div>
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <div class="panel">
          <div class="panel-heading">
            <div class="panel-title">配置信息列表</div>
            <a href="about_add.php" class="btn btn-info btn-gradient pull-right">
              <span class="glyphicons glyphicon-plus"></span>添加配置信息
            </a>
          </div>
          <form action="about_list.php" method="post">
            <div class="panel-body">
              <h2 class="panel-body-title">互联网</h2>
              <table class="table table-striped table-bordered table-hover dataTable">
                <tr class="active">
                  <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                  <!-- 标题、英文标题、内容、图片、添加时间、操作 -->
                  <th width="120">标题</th>
                  <th width="200">英文标题</th>
                  <th width="230">内容</th>
                  <th>图片</th>
                  <th>添加时间</th>
                  <th width="100">操作</th>
                </tr>
                <?php foreach($about as $item){ ?>
                <tr class="success">
                  <!-- 全选 -->
                  <td class="text-center"><input type="checkbox" value="<?php echo $item['about_id']; ?>" name="idarr[]" class="cbox"></td>
                  <!-- 标题 -->
                  <td><?php echo $item['about_title']; ?></td>
                  <!-- 英文标题 -->
                  <td><?php echo $item['about_title_en']; ?></td> 
                  <!-- 内容 -->
                  <td><?php echo mb_substr($item['about_content'],0,20); ?>...</td>
                  <!-- 图片 -->
                  <td>
                    <img src="<?php echo $item['about_img']; ?>"  width="100px" alt="" />
                  </td>
                  <!-- 添加时间 -->
                  <td><?php echo date("Y/m/d H:i",$item['about_time']); ?></td>
                  <!-- 操作 -->
                  <td>
                    <div class="btn-group">
                      <!-- 编辑 -->
                      <a href="about_edit.php?edit=<?php echo $item['about_id']; ?>" class="btn btn-default btn-gradient">
                        <span class="glyphicons glyphicon-pencil"></span>
                      </a>
                      <!-- 删除 -->
                      <a onclick="return confirm('确定要删除吗？');" 
                          href="<?php echo $url.'del='.$item['about_id'] ;?>"
                          class="btn btn-default btn-gradient dropdown-toggle"><span
                          class="glyphicons glyphicon-trash"></span>
                      </a>
                    </div>
                  </td>
                </tr>
                <?php }?>
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