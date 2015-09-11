<?php
$username = $_POST["username"];
$password = $_POST["password"];
if($username=="")  $core->message("error","Kullanıcı Adı alanı boş bırakılamaz !");
elseif($password=="")  $core->message("error","Şifre alanı boş bırakılamaz !");
else{
	$password = $password;
	$user = $core->get_row("musteriler","kullanici_adi,sifre,id","WHERE kullanici_adi='".$username."' AND sifre='".$password."'");	
	if($user){
		$core->message("success","Başarıyla Giriş Yapıldı.. Yönlendiriliyorsunuz.");
		$_SESSION["client_username"] = $user["kullanici_adi"];
		$_SESSION["client_password"] = $user["sifre"];
		$_SESSION["client_id"] = $user["id"];
		$core->parent_location("index.php");
	}else $core->message("error","Yanlış Kullanıcı Adı / Şifre");
}
?>