<?php
$m_query = mysql_query("SELECT id FROM musteriler");
while($m = mysql_fetch_assoc($m_query)){
	
	$musteri_id = $m["id"];
	
	$total_musteri_odeme = 0;
	$total_proje = 0;
	$p_query = mysql_query("SELECT id,fiyat FROM projeler WHERE musteri_id='".$musteri_id."'");
	while($p = mysql_fetch_assoc($p_query)){
		
		$proje_id = $p["id"];
		$proje_tutari = $p["fiyat"];
		$total_proje += $p["fiyat"];
		
		$total_odeme = 0;
		$o_query = mysql_query("SELECT tutar FROM odemeler WHERE musteri_id='".$musteri_id."' AND proje_id='".$proje_id."'");
		while($o = mysql_fetch_assoc($o_query)){
			$total_odeme += $o["tutar"];
			$total_musteri_odeme += $o["tutar"];
		}
		
		$update_proje = mysql_query("UPDATE projeler SET odenen_tutar='".$total_odeme."', kalan_tutar='".($proje_tutari-$total_odeme)."' WHERE id='".$proje_id."'");
		
		if(($proje_tutari-$total_odeme)==0){
			$update_proje = mysql_query("UPDATE projeler SET odeme_durum='1' WHERE id='".$proje_id."'");
		}
		
	}
	
	$update_musteri = mysql_query("UPDATE musteriler SET proje_toplam='".$total_proje."', toplam_odeme='".$total_musteri_odeme."', toplam_borc='".($total_proje-$total_musteri_odeme)."' WHERE id='".$musteri_id."'");
	
}
?>