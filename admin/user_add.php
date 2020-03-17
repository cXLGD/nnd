<?php
    include 'header.php';
    // pre($_POST);
    if(isset($_POST['sub'])){
        $user = $_POST['username'];
        $condition = "WHERE admin_name = '{$user}'";
        $admin = select_one('admin','admin_name',$condition);

        $upload_arr = array();
        $upload_arr['admin_name'] = $_POST['username'];
        $upload_arr['admin_password'] = md5($_POST['password']);
        $upload_arr['admin_reg_time'] = time();
        // pre($upload_arr);
        // pre($res);
        // pre($admin);
        //  die;

        if($admin['admin_name'] == $_POST['username']){
            echo "<script>alert('用户名已存在！');window.history.go(-1);</script>";
            die;
        }else{
            $res = insert('nnd_admin',$upload_arr);
            if($res['code']==1){
                echo "<script>alert('添加成功！');window.location.href='user_list.php';</script>";
                die;
            }else{
                echo "<script>alert('添加失败！');</script>";
        }
   }
 

   
}
?>
<link href="css/bootstrap-fileinput.css" rel="stylesheet">
        <!-- Start: Content -->
        <section id="content">
            <div id="topbar" class="affix">
                <ol class="breadcrumb">
                    <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                    <li class="active">注册</li>
                </ol>
            </div>
            <div class="container">
    
                <div class="row">
                    <div class="col-md-10 col-lg-8 center-column">
                        <form action="user_add.php" method="post" class="cmxform" enctype="multipart/form-data">
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="panel-title">添加管理员</div>
                                    <div class="panel-btns pull-right margin-left">
                                    <a href="#" onclick="window.history.go(-1);"
                                           class="btn btn-default btn-gradient dropdown-toggle"><span
                                                class="glyphicon glyphicon-chevron-left"></span></a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-7">
                                        <!-- <div class="form-group">
                                            <div class="input-group"><span class="input-group-addon">账号</span>
                                                <select name="name" id="standard-list1" class="form-control">
                                                    <?php //foreach($admin as $item){ ?>
                                                        <option value="<?php //echo $item['admin_id']; ?>">
                                                            <?php //echo $item['admin_name']; ?> 
                                                        </option>
                                                    <?php //} ?>                                             
                                                </select>
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <div class="input-group"><span class="input-group-addon">账号</span>
                                                <input type="text" name="username" value="" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group"><span class="input-group-addon">密码</span>
                                                <input type="password" name="password" value="" class="form-control" required/>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <!-- <div class="form-group col-md-12">
                                        <script type="text/plain" id="myEditor" style="width:100%;height:200px;">
                                            <p></p>
                                        </script>
                                    </div> -->
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <input name ="sub" type="submit" value="注册" class="submit btn btn-blue">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </section>
        <!-- End: Content -->
    </div>
<!-- End: Main -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-fileinput.js"></script>
<link type="text/css" rel="stylesheet" href="umeditor/themes/default/_css/umeditor.css">
<script src="umeditor/umeditor.config.js" type="text/javascript"></script>
<script src="umeditor/editor_api.js" type="text/javascript"></script>
<script src="umeditor/lang/zh-cn/zh-cn.js" type="text/javascript"></script>
<script type="text/javascript">
        var ue = UM.getEditor('myEditor', {
            autoClearinitialContent: false,//自动清除富文本框内容
            wordCount: false,
            elementPathEnabled: false,
            initialFrameHeight: 300
        });

    })
</script>
</body>
    
   