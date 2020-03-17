<?php
  include 'header.php';
  
  $config = select_all('config');




?>

<!-- Start: Content -->
<section id="content">
  <div id="topbar" class="affix">
    <ol class="breadcrumb">
      <li>
        <a href="#"><span class="glyphicon glyphicon-home"></span></a>
      </li>
      <li class="active">配置信息管理</li>
    </ol>
  </div>
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <div class="panel">
          <div class="panel-heading">
            <div class="panel-title">配置信息列表</div>
            <a href="#" class="btn btn-info btn-gradient pull-right">
              <span class="glyphicons glyphicon-plus"></span>添加配置信息
            </a>
          </div>
          <form action="" method="post">
            <div class="panel-body">
              <h2 class="panel-body-title">互联网</h2>
              <table class="table table-striped table-bordered table-hover dataTable">
                <tr class="active">
                  <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                  <!-- 地址、版权、备案、联系方式、添加时间、操作 -->
                  <th width="150">地址</th>
                  <th width="240">版权</th>
                  <th width="230">备案</th>
                  <th>联系方式</th>
                  <!-- <th>添加时间</th> -->
                  <th width="100">操作</th>
                </tr>
                <?php foreach($config as $item){ ?>
                <tr class="success">
                  <!-- 全选 -->
                  <td class="text-center"><input type="checkbox" value="<?php echo $item['config_id']; ?>" name="idarr[]" class="cbox"></td>
                  <!-- 地址 -->
                  <td><?php echo $item['config_addr']; ?></td>
                  <!-- 版权 -->
                  <td><?php echo $item['config_copy']; ?></td> 
                  <!-- 备案 -->
                  <td><?php echo $item['config_beian']; ?></td>
                  <!-- 联系方式 -->
                  <td>
                    <img src="<?php echo $item['config_contact']; ?>"  width="100px" alt="" />
                  </td>
                  <!-- 添加时间 -->
                  <!-- <td><?php echo date("Y/m/d H:i",$item['config_time']); ?></td> -->
                  <!-- 操作 -->
                  <td>
                    <div class="btn-group">
                      <!-- 编辑 -->
                      <a href="info_edit.php?edit=<?php echo $item['info_id']; ?>" class="btn btn-default btn-gradient">
                          <span class="glyphicons glyphicon-pencil"></span>
                      </a>
                      <a onclick="return confirm('确定要删除吗？');" 
                           href="<?php echo $url.'del='.$item['info_id'] ;?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span>
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
                <!-- <ul class="pagination" id="paginator-example">
                  <li><a href="#">&lt;&lt;</a></li>
                  <li><a href="#">&lt;</a></li>
                  <li><a href="#">1</a></li>
                  <li class="active"><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">&gt;</a></li>
                  <li><a href="#">&gt;&gt;</a></li>
                </ul> -->
                
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