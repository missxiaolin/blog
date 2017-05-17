<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>用户组添加用户 </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/static/font-awesome-4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/static/css/bjy.css">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/index.css">
</head>
<body>
<div class="bjy-admin-nav">
    <i class="fa fa-home"></i> 首页 
    &gt;
    后台管理
    &gt;
    管理员列表
</div>
<ul id="myTab" class="nav nav-tabs">
   <li class="active">
         <a href="<?php echo U('Admin/Rule/admin_user_list');?>">管理员列表</a>
   </li>
   <li>
        <a href="<?php echo U('Admin/Rule/add_admin');?>">添加管理员</a>
    </li>
</ul>
<table class="table table-striped table-bordered table-hover table-condensed">
    <tr>
        <th width="10%">用户名</th>
        <th>用户组</th>
        <th>操作</th>
    </tr>
    <?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
            <td><?php echo ($v['username']); ?></td>
            <td><?php echo ($v['title']); ?></td>
            <td>
                <a href="<?php echo U('Admin/Rule/edit_admin',array('id'=>$v['id']));?>">修改权限或密码</a>
            </td>
        </tr><?php endforeach; endif; ?>
</table>
 
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
</body>
</html>