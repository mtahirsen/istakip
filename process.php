<?php
if(! $_GET["s"]){
	include("config.php");
	include("class/class.sql.php"); 	$sql = new sql;
	include("class/class.core.php"); 	$core = new core;
	include("class/class.form.php"); 	$form = new form;
	// include("class/class.pager.php"); 	$pager = new pager;
	include("class/class.admin.php"); 	$admin = new admin;
	include("class/class.site.php"); 	$site = new site;
	if($admin->online()){
		$online_admin = $sql->get_row("admins","*","WHERE id='".$_SESSION["admin_id"]."'");	
	}
}
if($_GET["dispatch"]){
	
	$dispatch = explode('.',$_GET["dispatch"]);
	$module = $dispatch[0];
	$file = $dispatch[1];
	
	
	if($admin->online() || ($module=="admins" && $file=="login")){
			
		/* DEFINES */
		define("MODULE_FOLDER","admin/modules/".$module."/");
		define("MODULE_DISPLAY_FOLDER","admin/modules/".$module."/display/");
		define("MODULE_PROCESS_FOLDER","admin/modules/".$module."/process/");
		define("MODULE_LINK",$module);

		$inc = "admin/modules/".$module."/process/".$file.".php";
		if($_GET["no_settings"]!=1){
			$inc_settings = "admin/modules/".$module."/module.php";		
			if(file_exists($inc_settings)){
				include($inc_settings);
			}
		}
		if(file_exists($inc)){
			include($inc);
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

	$inc = "modules/".$module."/process/".$file.".php";
	if($_GET["no_settings"]!=1){
		$inc_settings = "modules/".$module."/module.php";		
		if(file_exists($inc_settings)){
			include($inc_settings);
		}
	}
	if(file_exists($inc)){
		include($inc);
	}
}
?>