<?php
if($_POST){
	if($form->empty_control($_POST,$empty2)){
		$_POST["baslangic_tarih"] = $core->mdc($_POST["baslangic_tarih"]);
		$_POST["bitis_tarih"] = $core->mdc($_POST["bitis_tarih"]);
		$_POST["kalan_tutar"] = $_POST["fiyat"];
		if($sql->quick_add(MODULE_TABLE2,$_POST)) unset($data);
		include(MODULE_FOLDER."/process/total_hesap.php");
	}
}
?>