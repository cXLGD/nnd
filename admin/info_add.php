<?php
    include 'header.php';
    //查询分类
    $info_type = select_all('info_type');  
    // pre($_POST);
    if(isset($_POST['sub'])){
        if(!$_FILES['pic1']['error'] >0){
            $upload = upload('pic1');
            if($upload['code'] == 1){
                $img = $upload['path'];    //path:路径
                //缩略图
                // pre($upload['filename']);
                // die;
                $thumb = thumb($img,150,102,'uploads/thumb',$upload['filename']);
            }
            $msg = $upload['msg'];
        }
       
        
        $upload_arr = array();
        $upload_arr['info_type'] = $_POST['type'];
        $upload_arr['info_title'] = $_POST['title'];
        $upload_arr['info_content'] = $_POST['editorValue'];
        $upload_arr['info_time'] = time();
        $upload_arr['info_img'] = $img;
        $upload_arr['info_thumb'] = $thumb;


        // $sql = "INSERT INTO `nnd_info` (`info_title`,`info_content`,`info_img`,`info_time`,`info_type`) VALUES ('$title','$content','$img','$time',$type)";
        $res = insert('nnd_info',$upload_arr);
        // pre($res);
        // die;


        if($res['code']==1){
            echo "<script>alert('添加成功！');window.location.href='info_list.php'</script>";
            die;
        }else{
            echo "<script>alert('添加成功！');</script>";
        }



    }




?>
        <link href="css/bootstrap-fileinput.css" rel="stylesheet">
        <!-- Start: Content -->
        <section id="content">
            <div id="topbar" class="affix">
                <ol class="breadcrumb">
                    <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                    <li class="active">添加资讯</li>
                </ol>
            </div>
            <div class="container">
    
                <div class="row">
                    <div class="col-md-10 col-lg-8 center-column">
                        <form action="" method="post" class="cmxform" enctype="multipart/form-data">
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="panel-title">添加文章</div>
                                    <div class="panel-btns pull-right margin-left">
                                    <a href="#" onclick="window.history.go(-1);"
                                           class="btn btn-default btn-gradient dropdown-toggle"><span
                                                class="glyphicon glyphicon-chevron-left"></span></a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <div class="input-group"><span class="input-group-addon">分类</span>
                                                <select name="type" id="standard-list1" class="form-control">
                                                    <?php foreach($info_type as $item){ ?>
                                                        <option value="<?php echo $item['info_type_id']; ?>">
                                                            <?php echo $item['info_type_name']; ?> 
                                                        </option>
                                                    <?php } ?>                                             
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group"><span class="input-group-addon">标题</span>
                                                <input type="text" name="title" value="" class="form-control" required/>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="input-group"><span class="input-group-addon">作者</span>
                                                <input type="text" name="author" value="admin" class="form-control">
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                        <input type="hidden" name="MAX_FILE_SIZE" VALUE="1048576">
                                        <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                                            <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                                <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src="images/noimage.png" alt="" />
                                            </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                            <div>
                                                <span class="btn btn-primary btn-file">
                                                    <span class="fileinput-new">选择文件</span>
                                                    <span class="fileinput-exists">换一张</span>
                                                    <input type="file" name="pic1" id="picID" accept="image/gif,image/jpeg,image/x-png"/>
                                                </span>
                                                <a href="javascript:;" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">移除</a>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <script type="text/plain" id="myEditor" style="width:100%;height:200px;">
                                            <p></p>
                                        </script>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <input name ="sub" type="submit" value="提交" class="submit btn btn-blue">
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

        $(function () {
        $('#uploadSubmit').click(function () {
            var data = new FormData($('#uploadForm')[0]);
            $.ajax({
                url: 'xxx/xxx',
                type: 'POST',
                data: data,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    if(data.status){
                        console.log('upload success');
                    }else{
                        console.log(data.message);
                    }
                },
                error: function (data) {
                    console.log(data.status);
                }
            });
        });

    })
    </script>
    </body>
    
   