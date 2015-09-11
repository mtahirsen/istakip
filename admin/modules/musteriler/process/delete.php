<?php
if($_GET["delete"]){
	$data = $sql->get_row(MODULE_TABLE,"*","WHERE id='".$_GET["delete"]."'");
	if($data){
		$delete_page = mysql_query("DELETE FROM ".MODULE_TABLE." WHERE id='".$_GET["delete"]."'");
	}
}
?>