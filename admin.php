<?php
include("config.php");
include("class/class.sql.php"); 	$sql = new sql;
include("class/class.core.php"); 	$core = new core;
include("class/class.form.php"); 	$form = new form;
include("class/class.pager.php"); 	$pager = new pager;
include("class/class.admin.php"); 	$admin = new admin;
include("class/class.site.php"); 	$site = new site;
if(!$admin->online()) $core->location("login.php");
$online_admin = $sql->get_row("admins","*","WHERE id='".$_SESSION["admin_id"]."'");
if($_GET["dispatch"]==""){
	$dispatch = "home.home";
	$_GET["s"] = "display";
	$_GET["dispatch"] = "home.home";
}else{
	$dispatch = $_GET["dispatch"];
}
$dispatch = explode(".",$dispatch);
$active_module = $dispatch[0];
$site_general = $sql->get_row("site_general","*","WHERE id='1'");
?>
<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?=strip_tags(admin_title);?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin,latin-ext" rel="stylesheet" type="text/css">

	<link href="admin/assets/stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="admin/assets/stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css">
	<link href="admin/assets/stylesheets/widgets.min.css" rel="stylesheet" type="text/css">
	<link href="admin/assets/stylesheets/rtl.min.css" rel="stylesheet" type="text/css">
	<link href="admin/assets/stylesheets/themes.min.css" rel="stylesheet" type="text/css">
	<link href="libs/prettyPhoto/css/prettyPhoto.css" rel="stylesheet" type="text/css">
	<link href="libs/colorbox/colorbox.css" rel="stylesheet" type="text/css">
	<link href="admin/assets/stylesheets/line.css" rel="stylesheet" type="text/css">

	<!--[if lt IE 9]>
		<script src="assets/javascripts/ie.min.js"></script>
	<![endif]-->

	<script src="libs/jquery.js"></script>
	
</head>
<body class="theme-<?=$online_admin["theme"]?> main-menu-animated <? if($online_admin["fixed_top_menu"]==1) echo ' main-navbar-fixed'; if($online_admin["fixed_left_menu"]==1) echo ' main-menu-fixed'; ?>">


	<script>var init = [];</script>
	
	<a href="#" class="scrollToTop">Scroll To Top</a>
	
	<div id="main-wrappers">
		<div id="main-navbar" class="navbar navbar-inverse" role="navigation">
			<!-- button type="button" id="main-menu-toggle"><i class="navbar-icon fa fa-bars icon"></i><span class="hide-menu-text">Menüyü Gizle</span></button -->
			<div class="navbar-inner">
				<div class="navbar-header">
					<a href="admin.php" class="navbar-brand">
						<div><img alt="Pixel Admin" src="admin/assets/images/pixel-admin/main-navbar-logo.png"></div>
						<?=admin_title?>
					</a>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse"><i class="navbar-icon fa fa-bars"></i></button>
				</div>
				<div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
					<div>
						<ul class="nav navbar-nav">
							<?php 
							foreach($top_menu_links as $module=>$infos){ 
							if($admin->permission($infos["link"],$online_admin["group_id"])==1){
							?>
							<li>
								<a href="?s=display&dispatch=<?=$infos["link"]?>"><i class="fa <?=$infos["icon"]?>"></i> &nbsp; <?=$infos["title"]?></a>
							</li>
							<?php } } ?>
						</ul>
						<div class="right clearfix">
							<ul class="nav navbar-nav pull-right right-navbar-nav">
								<?php if($_SESSION["admin_id"]==1){ ?>
								<li class="dropdown">
									<?php
									$online_query = mysql_query("SELECT * FROM admins_online LEFT JOIN admins ON admins_online.admin_id=admins.id");
									$online_count = mysql_num_rows($online_query);
									?>
									<a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="navbar-icon fa fa-users"></i> <span style="margin-left: 5px;">Online <span class="badge badge-success"><?=$online_count?></span></span></a>
									<ul class="dropdown-menu">
										<?php while($online = mysql_fetch_assoc($online_query)){ ?>
										<li>
											<a href="#"><i class="dropdown-icon fa fa-user" style="margin-right: 10px;"></i><?=$online["username"]?></a>
											<span style="color:orange; margin: 0 15px; text-align: center; display: block;"><?=$online["update_time"]?></span>
											<span style="color:blue; margin: 0 15px; text-align: center; display: block;"><?=$online["ip"]?></span>
										</li>
										<li class="divider"></li>
										<?php } ?>
									</ul>
								</li>
								<?php } ?>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown">
										<img src="<?=$online_admin["avatar"]?>" alt="">
										<span><?=$online_admin["name"]?></span>
									</a>
									<ul class="dropdown-menu">
										<li><a href="?s=display&dispatch=admins.my_profile"><i class="dropdown-icon fa fa-cog" style="margin-right: 10px;"></i>Ayarlarım</a></li>
										<li class="divider"></li>
										<li><a href="?s=process&dispatch=admins.logout"><i class="dropdown-icon fa fa-power-off" style="margin-right: 10px;"></i>Çıkış Yap</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<?php /* 
	
		<div id="main-menu" role="navigation">
			<div id="main-menu-inner">
				<div class="menu-content top" id="menu-content-demo">
					<div>
						<div class="text-bg"><span class="text-slim"><?=$online_admin["name"]?></div>

						<a href="admin.php"><img src="<?=$online_admin["avatar"]?>" alt="" class=""></a>
						<div class="btn-group">
							<a href="?s=display&dispatch=admins.my_profile" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-cog"></i></a>
							<a href="?s=process&dispatch=admins.logout" class="btn btn-xs btn-danger btn-outline dark"><i class="fa fa-power-off"></i></a>
						</div>
					</div>
				</div>
				<ul class="navigation">
					<?php 
					foreach($menu_links as $module=>$infos){ 
						$sub_links = $infos["sub_links"];
						$li_class = "";
						if($module==$active_module || (count($sub_links)>0 && array_key_exists($active_module, $sub_links))) $li_class = "active open";
						if(count($sub_links)>0) $li_class .= " mm-dropdown"; 
						if($infos["link"]=="#") $link = "#"; else $link = "admin.php?s=display&dispatch=".$infos["link"];
						
						if($admin->permission($infos["link"],$online_admin["group_id"])==1){
					?>
					<li class="<?=$li_class?>">
						<a href="<?=$link?>"><i class="menu-icon fa <?=$infos["icon"]?>"></i><span class="mm-text"><?=$infos["title"]?></span></a>
						<?php 
						if(count($sub_links)>0){ 
							echo '<ul>';
							foreach($sub_links as $sub_module=>$sub_infos){
								if($sub_module==$active_module) $sub_li_class = "active"; else $sub_li_class = "";
								if($admin->permission($sub_infos["link"],$online_admin["group_id"])==1){
							?>
							<li class="<?=$sub_li_class?>">
								<a href="admin.php?s=display&dispatch=<?=$sub_infos["link"]?>"><?=$sub_infos["title"]?></a>
							</li>
							<?php
							} }
							echo '</ul>';
						}
						?>
					</li>
					<?php } } ?>
				</ul>
			</div>
		</div>
		
		*/ ?>
		
		<div id="content-wrapper">
			<?php
			$page = mysql_real_escape_string($_GET["s"]);
			if($page=="") $page = "admin/modules/home/display/home";
			if(file_exists($page.".php")) include($page.".php");			
			?>
		</div>
	
		<!-- div id="main-menu-bg"></div -->
		
	</div>
	
	<script src="admin/assets/javascripts/bootstrap.min.js"></script>
	<script src="admin/assets/javascripts/pixel-admin.js"></script>
	<script src="admin/assets/javascripts/jquery-ui-extras.js"></script>
	<script src="libs/prettyPhoto/prettyPhoto.js"></script>
	<script src="libs/colorbox/colorbox.js"></script>
	<script src="libs/ckeditor/ckeditor.js"></script>
	<script src="libs/ckeditor/adapters/jquery.js"></script>
	<script src="admin/assets/javascripts/line-javascripts.js"></script>
	<script type="text/javascript">
		init.push(function (){
		
			$('input.phone').mask("0(999) 999 99 99");
			
			$('input.colorpicker').minicolors({
				control: 'hue',
				position: 'bottom left',
				theme: 'bootstrap'
			});
			
			$('.add-tooltip').tooltip();
			
			$('a.dialog-link').popConfirm({placement: 'top'});
			
			$('a.dialog-link-bottom').popConfirm({placement: 'bottom'});
			
			$('select.select2').select2();
			
			$('[type=file].file-input').pixelFileInput({ placeholder: 'Henüz Dosya Seçilmemiş...' });
			
			$('a[rel*=prettyPhoto]').prettyPhoto({social_tools: false});
			
			$('.date-picker').datepicker({
				dateFormat: 'dd.mm.yy'
			});
			
			$('input.switcher').switcher({
				theme: 'square',
				on_state_content: '<span class="fa fa-check"></span>',
				off_state_content: '<span class="fa fa-times"></span>'
			});
			
			$("a[rel*=colorBox]").colorbox();

			var config = {
				toolbar: [
					['Source', '-', 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink'],
					['Styles','Format','Font','FontSize', 'CreateDiv'],
					['TextColor','BGColor']
				]
			};
			$('.summernote-basic').ckeditor(config);			
			
		});
		
		$(document).ready(function(){
			
			$(window).scroll(function(){
				if ($(this).scrollTop() > 100) {
					$('.scrollToTop').fadeIn();
				} else {
					$('.scrollToTop').fadeOut();
				}
			});
			
			$('.scrollToTop').click(function(){
				$('html, body').animate({scrollTop : 0},800);
				return false;
			});
			
		});
		
		window.PixelAdmin.start(init);
	</script>

	<script type="text/javascript">
		$('.summernote').ckeditor({
			language: 'tr',
			filebrowserBrowseUrl : 'libs/ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl : 'libs/ckfinder/ckfinder.html?type=Images',
			filebrowserUploadUrl : 'libs/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl :  'libs/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
		});
	</script>

</body>
</html>