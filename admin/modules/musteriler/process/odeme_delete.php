<?php
if($_GET["delete"]){
	$data = $sql->get_row("odemeler","*","WHERE id='".$_GET["delete"]."'");
	if($data){
		$delete_page = mysql_query("DELETE FROM odemeler WHERE id='".$_GET["delete"]."'");
		$site->istatistik_olustur(date('Y-m-d',strtotime($data["odeme_tarihi"]." first day of this month")));
	}
}
?>