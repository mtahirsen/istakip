<?php
define("Module_Title","Yöneticiler");
define("Module_Key","Yönetici");
define("Module_Table","admins");
define("Module_Icon","fa-user");
define("Module_Link","admins");
define("Module_Folder","admin/modules/admins");

$empty = array(
	"username"=>array("title"=>"Kullanı Adı", "min"=>4, "max"=>20), 
	"name"=>"Adı Soyadı", 
	"email"=>array("title"=>"Email Adresi", "email_control"=>true), 
	"theme"=>"Panel Teması", 
);

if(ACTIVE_FILE=='add'){
	$empty["password"] = "Şifre";
	$empty["image"] = array("title"=>"Avatar", "type"=>"file");
}

$form->validator($empty);

$master_admins = array(1);
?>