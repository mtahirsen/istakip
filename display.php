<?php
if(! $_GET["s"]){
	include("config.php");
	include("class/class.sql.php"); 	$sql = new sql;
	include("class/class.core.php"); 	$core = new core;
	include("class/class.form.php"); 	$form = new form;
	include("class/class.pager.php"); 	$pager = new pager;
	include("class/class.admin.php"); 	$admin = new admin;
	include("class/class.site.php"); 	$site = new site;
	if($admin->online()){
		$online_admin = $core->get_row("admins","*","WHERE id='".$_SESSION["admin_id"]."'");	
	}
}



if($_GET["dispatch"]){
	if($admin->online()){
		$dispatch = explode('.',$_GET["dispatch"]);
		if($admin->permission($_GET["dispatch"],$online_admin["group_id"])==1){
		
			$module = $dispatch[0];
			$file = $dispatch[1];
			
			/* DEFINES */
			define("MODULE_FOLDER","admin/modules/".$module."/");
			define("MODULE_DISPLAY_FOLDER","admin/modules/".$module."/display/");
			define("MODULE_PROCESS_FOLDER","admin/modules/".$module."/process/");
			define("MODULE_LINK",$module);
			
			$inc_css = "admin/modules/".$module."/module.css";
			if(file_exists($inc_css)){
				echo '<link rel="stylesheet" href="'.$inc_css.'"/>';
			}	
			
			$inc_js = "admin/modules/".$module."/module.js";
			if(file_exists($inc_js)){
				echo '<script type="text/javascript" src="'.$inc_js.'"></script>';
			}	
			
			$inc_settings = "admin/modules/".$module."/module.php";
			if(file_exists($inc_settings)){
				include($inc_settings);
			}
			
			$inc = "admin/modules/".$module."/display/".$file.".php";
			if(file_exists($inc)){
				include($inc);
			}else{
				include("includes/404.php");
			}
			
			$inc_footer = "admin/modules/".$module."/module_footer.php";
			if(file_exists($inc_footer)){
				include($inc_footer);
			}			
			
		}else{
			include("includes/no_permission.php");
		}
	}else{
		$core->location("login.php");	
	}
}
if($_GET["manage"]){
	$dispatch = explode('.',$_GET["manage"]);
	$module = $dispatch[0];
	$file = $dispatch[1];

	/* DEFINES */
	define("MODULE_FOLDER","modules/".$module."/");
	define("MODULE_DISPLAY_FOLDER","modules/".$module."/display/");
	define("MODULE_PROCESS_FOLDER","modules/".$module."/process/");
	define("MODULE_LINK",$module);
	
	$inc_css = "modules/".$module."/module.css";
	if(file_exists($inc_css)){
		echo '<link rel="stylesheet" href="'.$inc_css.'"/>';
	}	
	
	$inc_js = "modules/".$module."/module.js";
	if(file_exists($inc_js)){
		echo '<script type="text/javascript" src="'.$inc_js.'"></script>';
	}	
	
	$inc_settings = "modules/".$module."/module.php";
	if(file_exists($inc_settings)){
		include($inc_settings);
	}
	
	$inc = "modules/".$module."/display/".$file.".php";
	if(file_exists($inc)){
		include($inc);
	}
}
?>