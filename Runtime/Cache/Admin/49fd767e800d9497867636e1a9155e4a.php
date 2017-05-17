<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加文章</title>
    <script src="/Public/static/js/jquery-2.0.0.min.js"></script>
<script>
    logoutUrl="<?php echo U('Index/User/logout');?>";
</script>
<script src="/Public/static/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="/Public/static/js/html5shiv.min.js"></script>
<script src="/Public/static/js/respond.min.js"></script>
<![endif]-->
<script src="/Public/static/pace/pace.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/static/font-awesome-4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/static/css/bjy.css">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/index.css">
    <link rel="stylesheet" type="text/css" href="/Public/static/uploadify/uploadify.css">
    
    <script src="/Public/static/uploadify/jquery.uploadify.min.js"></script>
        <link rel="stylesheet" href="/Public/static/iCheck-1.0.2/skins/all.css">
    
</head>
<body>
<form class="form-group" action="<?php echo U('Admin/Article/add');?>" method="post" enctype="multipart/form-data">
    <table class="table table-bordered table-striped table-hover table-condensed">
        <tr>
            <th width="80px">所属分类</th>
            <td>
                <select class="form-control modal-sm" name="cid">
                    <?php if(is_array($allCategory)): foreach($allCategory as $key=>$v): ?><option value="<?php echo ($v['cid']); ?>"><?php echo ($v['_name']); ?></option><?php endforeach; endif; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>标题</th>
            <td>
                <input class="form-control modal-sm" type="text" name="title">
            </td>
        </tr>
        <tr>
            <th>作者</th>
            <td>
                <input class="form-control modal-sm" type="text" name="author" value="<?php echo (C("AUTHOR")); ?>">
            </td>
        </tr>
        <tr>
            <th>标签</th>
            <td>
                <?php if(is_array($allTag)): foreach($allTag as $key=>$v): ?><span class="inputword"><?php echo ($v['tname']); ?></span>
                    <input class="icheck" type="checkbox" name="tids[]" value="<?php echo ($v['tid']); ?>">
                    &emsp;<?php endforeach; endif; ?>
            </td>
        </tr>
        <tr>
            <th>关键词</th>
            <td>
                <input class="form-control modal-sm" placeholder="多个关键词用顿号分隔" type="text" name="keywords">
            </td>
        </tr>
        <tr>
            <th>描述</th>
            <td>
                <textarea class="form-control modal-sm" name="description" rows="7" placeholder="可以不填，如不填；则截取文章内容前300字为描述"></textarea>
            </td>
        </tr>
        <tr>
        	<th>缩略图</th>
        	<td>
        		<div lab="uploadFile">
					<!-- file表单 -->
				    <input id="ff" type="file" multiple="true" style="display: inline-block;">
				    <span style="display: inline-block;">类型: *.jpg,*.png 大小: 2000KB 数量: 1</span>
				    <script type="text/javascript">
				        $(function() {
				            $('#ff').uploadify({
				               'formData'     : {
				               		//POST数据
				                    '<?php echo session_name();?>' : '<?php echo session_id();?>',
				                },
				                'fileTypeExts' : '*.jpg;*.png',
				                'swf'      : '/Public/static/uploadify/uploadify.swf',
				                'uploader' : '<?php echo U('upload');?>',//指定服务器上传的方法
				                'buttonText':'选择文件',
				                'fileSizeLimit' : '2000KB',
				                'uploadLimit' : 1,//上传文件数
				                'width':65,
				                'height':25,
				                'successTimeout':10,//等待服务器响应时间
				                'removeTimeout' : 0.2,//成功显示时间
				                'onUploadSuccess' : function(file, data, response) {
				                    //把php返回的数据转为json
				                    data=$.parseJSON(data);
				                    //获得图片地址
				                    var imageUrl = '/Tmps/'+data.savepath+data.savename;
				                    var imageAddress = './Tmps/'+data.savepath+data.savename;
				                    var li="<li>";
				                    li += "<img src='"+imageUrl+"'/>";
				                    li += "<input type='hidden' name='thumb' value='"+imageAddress+"'/><a href='javascript:;' id='self-close'>X</a>";
				                    li += "</li>";
				                    $("#uploadList ul").prepend(li);
				                }
				            });
				
							//关闭图片
				            var i = 1;
				            $(document).on('click','#self-close',function(){
				                $(this).parent('li').remove();
				                i++;
				                $('#ff').uploadify('settings','uploadLimit',i);
				            })
				        });
				    </script>
				    <div id="uploadList">
				        <ul>
							
				        </ul>
				    </div>
				    <style type="text/css">
				    	#uploadList ul li img{
				    		width: 175px;
				    		height: 120px;
				    	}
				    </style>
				</div>
        	</td>
        </tr>
        <tr>
            <th>内容</th>
            <td>
                <script id="container" name="content" type="text/plain"></script>
<script src="/Public/static/ueditor1_4_3/ueditor.config.js"></script>
<script src="/Public/static/ueditor1_4_3/ueditor.all.js"></script>
<script>
    var ue = UE.getEditor('container');
</script>
            </td>
        </tr>
        <tr>
            <th>是否原创</th>
            <td>
                <span class="inputword">是</span>
                <input class="icheck" type="radio" name="is_original" value="1" checked="checked">
                &emsp;
                <span class="inputword">否</span>
                <input class="icheck" type="radio" name="is_original" value="0">
            </td>
        </tr>
        <tr>
            <th>是否置顶</th>
            <td>
                <span class="inputword">是</span>
                <input class="icheck" type="radio" name="is_top" value="1">
                &emsp;
                <span class="inputword">否</span>
                <input class="icheck" type="radio" name="is_top" value="0" checked="checked">
            </td>
        </tr>
        <tr>
            <th>是否显示</th>
            <td>
                <span class="inputword">是</span>
                <input class="icheck" type="radio" name="is_show" value="1" checked="checked">
                &emsp;
                <span class="inputword">否</span>
                <input class="icheck" type="radio" name="is_show" value="0">
            </td>
        </tr>
        <tr>
            <th></th>
            <td>
                <input class="btn btn-success" type="submit" value="发表">
            </td>
        </tr>
    </table>
</form>

<script src="/Public/static/iCheck-1.0.2/icheck.min.js"></script>
<script>
$(document).ready(function(){
    $('.icheck').iCheck({
        checkboxClass: "icheckbox_square-blue",
        radioClass: "iradio_square-blue",
        increaseArea: "20%"
    });
});
</script>
</body>
</html>