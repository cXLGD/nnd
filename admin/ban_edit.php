<?php
        include 'header.php';
        $bantype = select_all('bantype');

        if(isset($_GET['edit']) && $_GET['edit'] >0){
            $id = $_GET['edit'];
            // pre($id);
            // die;

            $condition = "WHERE ban_id = {$id} ";
            $banner = select_one('banner','*',$condition);
            // var_dump($banner);
            // die;
            // $old_img = $banner['ban_img'];
        }
        if(isset($_POST['edit'])){
            $id = $_POST['ban_id'];
            
            $upload_arr = array();
            //如果有文件上传
            // pre($_POST);
            if($_FILES['pic1']['error'] == 0){
                $upload = upload('pic1');
                if($upload['code'] ==1){
                    $img = $upload['path'];
                }
                $old_img = $_POST['old_img'];
                // pre($old_img);
                // die;
                unlink($old_img);

                $msg = $upload['msg'];
                // pre($msg);

                $upload_arr['ban_type'] = $_POST['type'];
                $upload_arr['ban_name'] = $_POST['name'];
                // $upload_arr['ban_content'] = $_POST['editorValue'];
                $upload_arr['ban_time'] = time();
                $upload_arr['ban_url'] = $img;
            }else{
                $upload_arr['ban_type'] = $_POST['type'];
                $upload_arr['ban_name'] = $_POST['name'];
                // $upload_arr['ban_content'] = $_POST['editorValue'];
                $upload_arr['ban_time'] = time();
            }
            $condition = "WHERE ban_id = {$id}";
            $res = update('nnd_banner',$upload_arr,$condition);
            // die;
            if($res['code'] == 1){
                echo "<script>alert('修改成功！');window.location.href='ban_list.php'</script>";
                die;
            }else{
                echo "<script>alert('修改失败！');</script>";
            }

            
        }
        



    ?>
    <!-- Start: Content -->
    <link href="css/bootstrap-fileinput.css" rel="stylesheet">
    <section id="content">
        <div id="topbar" class="affix">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">修改资讯</li>
            </ol>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 center-column">
                    <form action="#" method="post" class="cmxform" enctype="multipart/form-data">
                    <input type="hidden" name="ban_id" value="<?php echo $banner['ban_id']; ?>">
                    <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title">编辑文章</div>
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
                                                <!-- <option>请选择</option> -->
                                                <?php foreach($bantype as $item){ ?>
                                                    <option value="<?php echo $item['ban_type_id']; ?>" 
                                                    <?php if($item['ban_type_id']== $banner['ban_type']){echo 'selected="selected"';} ?>>
                                                        <?php echo $item['ban_type_name']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">名字</span>
                                            <input type="text" name="name" value="<?php $banner['ban_name']; ?>"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="MAX_FILE_SIZE" VALUE="1048576">
                                        <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                                            <input type="hidden" name="old_img" value="<?php echo $banner['ban_url'];?>"/>
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
                                    <!-- <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">作者</span>
                                            <input type="text" name="author" value="admin" class="form-control">
                                        </div>
                                    </div> -->
                                </div>
                                <div class="form-group col-md-12">
                                    <script type="text/plain" id="myEditor" style="width:100%;height:200px;">
					<p></p>

                                    </script>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input name="edit" type="submit" value="提交" class="submit btn btn-blue">
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
    