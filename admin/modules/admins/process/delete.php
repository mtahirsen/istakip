<?php
if($_GET["delete"]){
	$data = $core->get_row(Module_Table,"*","WHERE id='".$_GET["delete"]."'");
	if($data){
		$delete_query = mysql_query("DELETE FROM ".Module_Table." WHERE id='".$_GET["delete"]."'");
		if($delete_query){
			@unlink($data["avatar"]); 
			@unlink(str_replace("image_","",$data["avatar"]));	
		}
	}
}
?>