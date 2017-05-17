<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <title>小林博客</title>
	<meta name="baidu-site-verification" content="ZrzUPzPgpR" />
	<link rel="icon" href="/favicon.ico" type="image/x-icon" />

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/static/font-awesome-4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/static/css/bjy.css">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/index.css">
	<link href="/Public/Index/css/base.css" rel="stylesheet">
	<link href="/Public/Index/css/index.css" rel="stylesheet">
</head>
<body>
<!--头部-->
<header>
		  <div id="logo"><a href="<?php echo U('Index/Index/index');?>"></a></div>
		  <nav class="topnav" id="topnav">
		  	<a href="<?php echo U('Index/Index/index');?>" id="topnav_current"><span>首页</span></a>
		  	<?php if(is_array($data)): foreach($data as $key=>$v): ?><a href="<?php echo U('Index/Index/new_list',array('cid'=>$v['cid']));?>"><span><?php echo ($v['cname']); ?></span></a><?php endforeach; endif; ?>
		  	<a href="<?php echo U('Index/Index/about');?>"><span>关于我</span></a>
		  	<!--<a href="newlist.html"><span>开源项目</span></a>-->
		  	<!--<a href="newlist.html"><span>慢生活</span></a>-->
		  	<!--<a href="moodlist.html"><span>碎言碎语</span></a>-->
		  	<!--<a href="share.html"><span>模板分享</span></a>-->
		  	<!--<a href="knowledge.html"><span>学无止境</span></a>-->
		  	<!--<a href="book.html"><span>留言版</span></a>-->
		  </nav>
	      <div class="login">
			  <?php if(empty($_SESSION['users']['head_img'])): ?><a href="javascript:;" onclick="login()">登陆</a>
			  <?php else: ?>
				  <div class="headPortrait">
					  <img src="<?php echo ($_SESSION['users']['head_img']); ?>" />

					  <div class="login_right">
						  <span class="username"><?php echo ($_SESSION['users']['nickname']); ?></span>
						  <a href="javascript:;" onclick="logout()">退出</a>
					  </div>



				  </div><?php endif; ?>

		  </div>

		</header>
		<!-- 登录模态框开始 -->
		<div class="modal fade" id="b-modal-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content row">
					<div class="col-xs-12 col-md-12 col-lg-12">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title b-ta-center" id="myModalLabel">无需注册，用以下帐号即可直接登录</h4>
						</div>
					</div>
					<div class="col-xs-12 col-md-12 col-lg-12 b-login-row">
						<ul class="row">
							<li class="col-xs-6 col-md-4 col-lg-4 b-login-img">
								<a href="<?php echo U('Index/User/oauth_login',array('type'=>'qq'));?>"><img src="/Public/Home/image/qq-login.png" alt="QQ登录" title="QQ登录"></a>
							</li>

						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- 登录模态框结束 -->
		<!-- 引入bootstrjs部分开始 -->
		<script src="/Public/static/js/jquery-2.0.0.min.js"></script>
<script>
    logoutUrl="<?php echo U('Index/User/logout');?>";
</script>
<script src="/Public/static/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<script src="/Public/Home/js/index.js"></script>
		<!-- 引入bootstrjs部分结束 -->

<div class="banner">
	<section class="box">
		<ul class="texts">
			<p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
			<p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
			<p>加了锁的青春，不会再因谁而推开心门。</p>
		</ul>
		<div class="avatar"><a href="<?php echo U('Index/Index/about');?>"><span>小林</span></a> </div>
	</section>
</div>
<div class="template">
	<div class="box">
		<h3>
			<p><span>个人</span>作品 PROJECT</p>
		</h3>
		<ul>
			<li><a href="<?php echo U('Index/Static/statics',['type'=>'jd']);?>"  target="_blank"><img src="/Public/Index/images/01.jpg"></a><span>仿京东静态页面</span></li>
			<li><a href="<?php echo U('Index/Static/statics',['type'=>'tm']);?>" target="_blank"><img src="/Public/Index/images/02.jpg"></a><span>仿天猫静态页面</span></li>
			<li><a href="<?php echo U('Index/Static/statics',['type'=>'xys']);?>"  target="_blank"><img src="/Public/Index/images/03.jpg"></a><span>响应式页面</span></li>
			<li><a href="<?php echo U('Index/Static/statics',['type'=>'shop']);?>" target="_blank"><img src="/Public/Index/images/04.jpg"></a><span>仿天猫移动端静态页面</span></li>
			<li><a href="<?php echo U('Index/Static/statics',['type'=>'damai']);?>"  target="_blank"><img src="/Public/Index/images/05.jpg"></a><span>仿大卖网静态页面</span></li>
			<li><a href="<?php echo U('Index/Static/statics',['type'=>'fk']);?>"  target="_blank"><img src="/Public/Index/images/06.jpg"></a><span>仿凡客静态页面</span></li>
		</ul>
	</div>
</div>
<article>
	<h2 class="title_tj">
		<p>文章<span>推荐</span></p>
	</h2>
	<div class="bloglist left">
		<?php if(is_array($articles)): foreach($articles as $key=>$v): ?><h3><?php echo ($v['title']); ?></h3>
			<figure><img src="<?php echo ($v['thumb']); ?>"></figure>
			<ul>
				<p><?php echo ($v['description']); ?></p>
				<a title="<?php echo ($v['title']); ?>" href="<?php echo U('Index/Index/content',array('aid'=>$v['aid']));?>" target="_blank" class="readmore">阅读全文>></a>
			</ul>
			<p class="dateview"><span><?php echo (date("Y-m-d",$v['addtime'])); ?></span><span>作者：<?php echo ($v['author']); ?></span><span>分类：[<a href="/news/life/"><?php echo ($v['category']['cname']); ?></a>]</span></p><?php endforeach; endif; ?>
		<div style="text-align: center;">
			<?php echo ($page); ?>
		</div>
	</div>
	<aside class="right">
		<div class="weather"><iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe></div>
		<div class="news">
			<h3>
		      <p>置顶<span>文章</span></p>
		    </h3>
		    <ul class="rank">
		    	<?php if(is_array($recommend)): foreach($recommend as $key=>$v): ?><li>
		    			<a href="<?php echo U('Index/Index/content',array('aid'=>$v['aid']));?>" title="<?php echo ($v['title']); ?>" target="_blank"><?php echo ($v['title']); ?></a>
		    		</li><?php endforeach; endif; ?>
		    </ul>
		    <h3 class="ph">
		      <p>点击<span>排行</span></p>
		    </h3>
		    <ul class="paih">
		    	<?php if(is_array($clickArticle)): foreach($clickArticle as $key=>$v): ?><li>
		    			<a href="<?php echo U('Index/Index/content',array('aid'=>$v['aid']));?>" title="<?php echo ($v['title']); ?>" target="_blank"><?php echo ($v['title']); ?></a>
		    		</li><?php endforeach; endif; ?>
		    </ul>
		    

			<h3 class="links">
				<p>友情<span>链接</span></p>
			</h3>
			<ul class="website">
				<?php if(is_array($link)): foreach($link as $key=>$v): ?><li>
						<a href="<?php echo ($v['url']); ?>" target="_blank"><?php echo ($v['lname']); ?></a>
					</li><?php endforeach; endif; ?>
			</ul>
		</div>
		<!-- Baidu Button BEGIN -->
		<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
		<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
		<script type="text/javascript" id="bdshell_js"></script>
		<script type="text/javascript">
			document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
		</script>
		<!-- Baidu Button END -->
		<a href="javascript:;" class="weixin"> </a>
	</aside>
</article>

<!--尾部-->
<footer>
		  <p>Design by DanceSmile <a href="javascript:;" target="_blank">浙ICP备16034842号-1</a></p>
		  <p>联系邮箱：462441355@qq.com  联系号码：17135501105</p>
		</footer>
</body>
</html>