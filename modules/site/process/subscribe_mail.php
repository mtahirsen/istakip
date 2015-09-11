<div style="font-size: 12px; position: absolute; padding: 10px; width: 100%;">
<?php
if($_POST["email"]==""){
	echo 'Email adresi boş bırakılamaz.';
}elseif(! $core->email_control($_POST["email"],1)){
	echo 'Geçersiz email adresi!';
}elseif(mysql_num_rows(mysql_query("SELECT * FROM emails WHERE email='".$_POST["email"]."'"))>0){
	echo 'Bu mail adresi daha önce eklenmiş.';
}else{
	mysql_query("INSERT INTO emails SET email='".$_POST["email"]."'");
	echo 'Mail adresi başarıyla eklendi.';
}
?>
</div>