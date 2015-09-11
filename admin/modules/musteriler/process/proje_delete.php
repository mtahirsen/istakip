<?php
if($_GET["delete"]){
	$data = $sql->get_row("projeler","*","WHERE id='".$_GET["delete"]."'");
	if($data){
		$delete_page = mysql_query("DELETE FROM projeler WHERE id='".$_GET["delete"]."'");
	}
}
?>