<?php
if($_POST){
	if($form->empty_control($_POST,$empty)){		
		if($sql->quick_add(MODULE_TABLE,$_POST)) unset($data);
	}
}
?>