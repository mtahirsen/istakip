<?php
$date1 = "2015-03-01";
$date2 = "2015-04-01";
/*
$date1ex = explode("-",$date1);
$date2ex = explode("-",$date2);

$query1 = $sql->get_data("SELECT  ROUND(SUM(fiyat), 2) AS toplam_fiyat FROM projeler WHERE baslangic_tarih>='".$date1."' AND baslangic_tarih<='".$date2."'");
$query2 = $sql->get_data("SELECT  ROUND(SUM(fiyat), 2) AS toplam_fiyat FROM projeler WHERE bitis_tarih>='".$date1."' AND bitis_tarih<='".$date2."'");
$query3 = $sql->get_data("SELECT  ROUND(SUM(tutar), 2) AS toplam_fiyat FROM odemeler WHERE odeme_tarihi>='".$date1."' AND odeme_tarihi<='".$date2."'");

$total["yil"] = $date1ex[0];
$total["ay"] = $date1ex[1];
$total["baslanan_proje"] = mysql_num_rows(mysql_query("SELECT id FROM projeler WHERE baslangic_tarih>='".$date1."' AND baslangic_tarih<='".$date2."'"));
$total["biten_proje"] = mysql_num_rows(mysql_query("SELECT id FROM projeler WHERE bitis_tarih>='".$date1."' AND bitis_tarih<='".$date2."'"));
$total["baslanan_proje_toplam_fiyat"] = $query1["toplam_fiyat"];
$total["biten_proje_toplam_fiyat"] = $query2["toplam_fiyat"];
$total["toplam_odenen_fiyat"] = $query3["toplam_fiyat"];

$sql->quick_add("istatistikler",$total);

$core->line_print($total);
*/
?>
<div class="page-header">
	<div class="row">
		<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-file page-header-icon"></i>&nbsp;&nbsp; İşGüç Takip v.1 (Özet Oluşturma)</h1>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<h2><?=$core->ndc($date1)." - ".$core->ndc($date2)?> Arasında Yapılan İşlemler;</h2>
		<ul class="list-group">
			<li class="list-group-item">
				<span class="badge badge-inverse"><?=$total["baslanan_proje"]?></span>
				<strong><?=$core->tr_date($date1)?></strong> Başlanan Proje
			</li>
			<li class="list-group-item">
				<span class="badge badge-inverse"><?=$total["biten_proje"]?></span>
				<strong><?=$core->tr_date($date1)?></strong> Biten Proje
			</li>
		</ul>
	</div>
</div>