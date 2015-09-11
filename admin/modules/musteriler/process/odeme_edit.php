<?php
if($_POST){
	if($form->empty_control($_POST,$empty3)){
		$_POST["odeme_tarihi"] = $core->mdc($_POST["odeme_tarihi"]);
		if($sql->quick_edit(MODULE_TABLE3,"WHERE id='".$_GET["id"]."'",$_POST)){
			include(MODULE_FOLDER."/process/total_hesap.php");
			$core->parent_location("?s=display&dispatch=musteriler.odemeler&proje_id=".$_POST["proje_id"]."&musteri_id=".$_POST["musteri_id"]);
		}
	}
}
?>