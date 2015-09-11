<?php
if($_POST){
	if($form->empty_control($_POST,$empty)){
		if($sql->quick_edit(MODULE_TABLE,"WHERE id='".$_GET["id"]."'",$_POST)) $data = $sql->get_row(MODULE_TABLE,"*","WHERE id='".$_GET["id"]."'");	
	}
}
?>