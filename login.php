<?php include("config.php"); ?>
<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?=strip_tags(admin_login_title);?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

	<!-- Open Sans font from Google CDN -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin,latin-ext" rel="stylesheet" type="text/css">

	<!-- Pixel Admin's stylesheets -->
	<link href="admin/assets/stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="admin/assets/stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css">
	<link href="admin/assets/stylesheets/pages.min.css" rel="stylesheet" type="text/css">
	<link href="admin/assets/stylesheets/rtl.min.css" rel="stylesheet" type="text/css">
	<link href="admin/assets/stylesheets/themes.min.css" rel="stylesheet" type="text/css">

	<!--[if lt IE 9]>
		<script src="assets/javascripts/ie.min.js"></script>
	<![endif]-->

</head>
<body class="theme-default page-signin-alt">

	<div class="signin-header">
		<a href="index.html" class="logo">
			<div class="demo-logo bg-primary"><img src="admin/assets/demo/logo-big.png" alt="" style="margin-top: -4px;"></div>&nbsp;
			<?=admin_login_title?>
		</a>
	</div>
	
	<h1 class="form-header">Lütfen Giriş Yapın</h1>
	
	<form action="javascript:$.admins.login()" id="signin" class="panel">
		<div id="login_result"></div>
		<div class="form-group">
			<input type="text" name="signin_username" id="username" class="form-control input-lg" placeholder="Kullanıcı Adınız" autofocus>
		</div>
		<div class="form-group signin-password">
			<input type="password" name="signin_password" id="password" class="form-control input-lg" placeholder="Şifreniz">
		</div>
		<div class="form-actions">
			<input type="submit" value="Giriş Yap" class="btn btn-primary btn-block btn-lg">
		</div>
	</form>	
	
	<script src="libs/jquery.js"></script>

	<!-- Pixel Admin's javascripts -->
	<script src="admin/assets/javascripts/bootstrap.min.js"></script>
	<script src="admin/assets/javascripts/pixel-admin.js"></script>
	<script src="admin/modules/admins/admins.js"></script>

	<script type="text/javascript">
		window.PixelAdmin.start([
			function () {
				$("#signin").validate({ focusInvalid: true, errorPlacement: function () {} });
				
				$("#username").rules("add", {
					required: true,
					minlength: 3
				});

				$("#password").rules("add", {
					required: true,
					minlength: 6
				});
			}
		]);
	</script>
	
</body>
</html>