<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo ($title); ?></title>
	<script src="<?php echo U('Public/bower_components/jquery/dist/jquery.min.js');?>"></script>
	<script src="<?php echo U('Public/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
	<link rel="stylesheet" href="<?php echo U('Public/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php echo U('Public/css/style.css');?>">

	<!--	<META HTTP-EQUIV="REFRESH" CONTENT="100;URL=<?php echo ($next_url); ?>?>" /> -->

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="<?php echo U('bootstrap/js/html5shiv.min.js');?>"></script>
		<script src="<?php echo U('bootstrap/js/respond.min.js');?>"></script>
	<![endif]-->
</head>
<body>
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Sport.com</span> <span class="icon-bar"></span>
					<span class="icon-bar"></span> <span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo U('index');?>">Sport.com</a>
			</div>
			<!-- end of navbar-header -->
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="<?php echo U();?>">主页</a></li>
					<li><a href="#">关于</a></li>
					
					<li><form class="navbar-form">
					<input class="span2" type="text" placeholder="搜一下">
					<button type="submit" class="btn">搜索</button>
				</form></li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
					<li><input type="button" class="btn btn-default navbar-btn"
						onclick="javascript:window.location.href='<?php echo U('user/regist');?>';"
						value="注册" /></li>
					<li>&nbsp;&nbsp;&nbsp;</li>
					<li>
						<input type="button" class="btn btn-default navbar-btn" onclick="javascript:window.location.href='<?php echo U('user/login');?>';" value="登录" />
					</li>
				</ul>
			</div><!-- collapse -->
		</div><!-- container -->
	</div><!-- navbar --> 

<link rel="stylesheet" href="<?php echo U('Public/css/user.css');?>">
<div class="container" id="reg_div" >
	<form action='<?php echo U('user/regist');?>' method='post' id="register_form" class="form-signin" role="form">
    <input type="hidden" name="method" value="do"/>
		<div class="form_head">
			<div class ="form_title" id="form_title"><h3>注册</h3></div>
			<div class ="change_link" id="change_link"><h3><a href="<?php echo U('user/login');?>" id="login_form_show">登录</a></h3></div>
		</div>
        <input type="email"    name="reg_email" id="reg_email" class="form-control" value="<?php echo(isset($reg_email_save)?$reg_email_save:''); ?>" placeholder="邮箱" required autofocus>
        <input type="username" name="reg_username" id="reg_username" class="form-control" value="<?php echo(isset($reg_username_save)?$reg_username_save:''); ?>" placeholder="用户名" required>
        <input type="password" name="reg_password" id="reg_password" class="form-control" placeholder="密码" required>
        
      <?php if(isset($err)): ?><div class="alert alert-danger" role="alert">
        <ul>
   		   		<li><?php echo ($err); ?></li>
   		   </ul>
    	   </div><?php endif; ?>
    	
    	<button class="btn btn-lg btn-primary btn-block" type="submit">注册</button>
	</form>
</div>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php U('/js/ie10-viewport-bug-workaround.js') ?>"></script>
  </body>
</html>



<div class="container col-md-12">
	<div class="footer_box">
		<p class="text-center">Copyright &copy; JasonLiu | Powered by Laravel Bootstrap</p>
	</div> 
</div> 
</body>
</html>