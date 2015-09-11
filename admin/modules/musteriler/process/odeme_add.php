<?php
if($_POST){
	if($form->empty_control($_POST,$empty3)){
		$_POST["odeme_tarihi"] = $core->mdc($_POST["odeme_tarihi"]);
		if($sql->quick_add(MODULE_TABLE3,$_POST)){
			$site->istatistik_olustur(date('Y-m-d',strtotime($_POST["odeme_tarihi"]." first day of this month")));
			include(MODULE_FOLDER."/process/total_hesap.php");
			unset($data);
		}
	}
}
?>