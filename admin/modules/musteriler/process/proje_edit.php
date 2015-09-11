<?php
if($_POST){
	if($form->empty_control($_POST,$empty2)){
		$_POST["baslangic_tarih"] = $core->mdc($_POST["baslangic_tarih"]);
		$_POST["bitis_tarih"] = $core->mdc($_POST["bitis_tarih"]);
		if($sql->quick_edit(MODULE_TABLE2,"WHERE id='".$_GET["id"]."'",$_POST)) $core->parent_location("?s=display&dispatch=musteriler.projeler&musteri_id=".$_POST["musteri_id"]);
		include(MODULE_FOLDER."/process/total_hesap.php");
	}
}
?>