<?php
$username = $_POST["username"];
$password = $_POST["password"];
if($username=="")  $core->message("error","Kullanıcı Adı alanı boş bırakılamaz !");
elseif($password=="")  $core->message("error","Şifre alanı boş bırakılamaz !");
else{
	$password = $core->password($password);
	// echo $password;
	$user = $core->get_row("admins","username,password,id","WHERE username='".$username."' AND password='".$password."'");	
	if($user){
		$core->message("success","Başarıyla Giriş Yapıldı.. Yönlendiriliyorsunuz.");
		$_SESSION["admin_username"] = $user["username"];
		$_SESSION["admin_password"] = $user["password"];
		$_SESSION["admin_id"] = $user["id"];
		$core->parent_location("admin.php");
	}else $core->message("error","Yanlış Kullanıcı Adı / Şifre");
}
?>