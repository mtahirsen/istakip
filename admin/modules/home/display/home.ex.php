<div class="page-header">
	<div class="row">
		<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-file page-header-icon"></i>&nbsp;&nbsp; İşGüç Takip v.1</h1>
	</div>
</div>
<div class="row">
	<div class="col-sm-3">
		<ul class="list-group">
			<li class="list-group-item">
				<span class="badge badge-info"><?=mysql_num_rows(mysql_query("SELECT id FROM musteriler"))?></span>
				Toplam Müşteri Sayısı
			</li>
			<li class="list-group-item">
				<span class="badge badge-warning"><?=mysql_num_rows(mysql_query("SELECT id FROM projeler"))?></span>
				Toplam Proje Sayısı
			</li>
			<li class="list-group-item">
				<span class="badge badge-danger"><?=mysql_num_rows(mysql_query("SELECT id FROM projeler WHERE baslangic_tarih>='".date("Y-m-d", strtotime("1 ".date("M Y", time())))."'"))?></span>
				Bu Ay Başlanan Proje Sayısı
			</li>
			<li class="list-group-item">
				<span class="badge badge-success"><?=mysql_num_rows(mysql_query("SELECT id FROM projeler WHERE bitis_tarih>='".date("Y-m-d", strtotime("1 ".date("M Y", time())))."'"))?></span>
				Bu Ay Biten Proje Sayısı
			</li>
		</ul>
	</div>
	<div class="col-sm-4">
		<ul class="list-group">
			<?php $total = $sql->get_data("SELECT ROUND(SUM(fiyat), 2) AS toplam_fiyat FROM projeler"); ?>
			<li class="list-group-item">
				<span class="badge badge-info"><?=number_format($total["toplam_fiyat"],2)?> TL</span>
				Projelerin Toplam Fiyatı
			</li>
			<?php $total = $sql->get_data("SELECT ROUND(SUM(tutar), 2) AS toplam_odenen FROM odemeler"); ?>
			<li class="list-group-item">
				<span class="badge badge-warning"><?=number_format($total["toplam_odenen"],2)?> TL</span>
				Toplam Ödenen Tutar
			</li>
			<?php $total = $sql->get_data("SELECT ROUND(SUM(kalan_tutar), 2) AS toplam_kalan FROM projeler"); ?>
			<li class="list-group-item">
				<span class="badge badge-danger"><?=number_format($total["toplam_kalan"],2);?> TL</span>
				Toplam Kalan Borç
			</li>
			<?php $total = $sql->get_data("SELECT ROUND(SUM(tutar), 2) AS ay_toplam_odenen FROM odemeler WHERE odeme_tarihi>='".date("Y-m-d", strtotime("1 ".date("M Y", time())))."'"); ?>
			<li class="list-group-item">
				<span class="badge badge-success"><?=number_format($total["ay_toplam_odenen"],2)?> TL</span>
				Bu Ay Toplam Ödenen Tutar
			</li>
		</ul>
	</div>
	<div class="col-sm-5">
		<?php
		$l5 = date("Y-m-d", strtotime("-5 Months 1".date("M Y", time())));
		$l4 = date("Y-m-d", strtotime("-4 Months 1".date("M Y", time())));
		$l3 = date("Y-m-d", strtotime("-3 Months 1".date("M Y", time())));
		$l2 = date("Y-m-d", strtotime("-2 Months 1".date("M Y", time())));
		$l1 = date("Y-m-d", strtotime("-1 Months 1".date("M Y", time())));
		$l0 = date("Y-m-d", strtotime("1".date("M Y", time())));
		?>
		<ul class="list-group">
			<?php 
			$total["proje"][1] = $sql->get_data("SELECT ROUND(SUM(fiyat), 2) AS toplam_fiyat FROM projeler WHERE bitis_tarih>'".$l5."' AND bitis_tarih<'".$l4."'");
			$total["odeme"][1] = $sql->get_data("SELECT ROUND(SUM(tutar), 2) AS toplam_odenen FROM odemeler WHERE odeme_tarihi>'".$l5."' AND odeme_tarihi<'".$l4."'");
			?>
			<li class="list-group-item">
				<span class="badge badge-success"><?=number_format($total["odeme"][1]["toplam_odenen"],2)?> TL</span>
				<span class="badge badge-warning"><?=number_format($total["proje"][1]["toplam_fiyat"],2)?> TL</span>
				<strong><?=$core->tr_date($l5)?></strong> | Biten Proje Tutarı | Toplam Ödeme
			</li>
			<?php 
			$total["proje"][1] = $sql->get_data("SELECT ROUND(SUM(fiyat), 2) AS toplam_fiyat FROM projeler WHERE bitis_tarih>'".$l4."' AND bitis_tarih<'".$l3."'");
			$total["odeme"][1] = $sql->get_data("SELECT ROUND(SUM(tutar), 2) AS toplam_odenen FROM odemeler WHERE odeme_tarihi>'".$l4."' AND odeme_tarihi<'".$l3."'");
			?>
			<li class="list-group-item">
				<span class="badge badge-success"><?=number_format($total["odeme"][1]["toplam_odenen"],2)?> TL</span>
				<span class="badge badge-warning"><?=number_format($total["proje"][1]["toplam_fiyat"],2)?> TL</span>
				<strong><?=$core->tr_date($l4)?></strong> | Biten Proje Tutarı | Toplam Ödeme
			</li>
			<?php 
			$total["proje"][1] = $sql->get_data("SELECT ROUND(SUM(fiyat), 2) AS toplam_fiyat FROM projeler WHERE bitis_tarih>'".$l3."' AND bitis_tarih<'".$l2."'");
			$total["odeme"][1] = $sql->get_data("SELECT ROUND(SUM(tutar), 2) AS toplam_odenen FROM odemeler WHERE odeme_tarihi>'".$l3."' AND odeme_tarihi<'".$l2."'");
			?>
			<li class="list-group-item">
				<span class="badge badge-success"><?=number_format($total["odeme"][1]["toplam_odenen"],2)?> TL</span>
				<span class="badge badge-warning"><?=number_format($total["proje"][1]["toplam_fiyat"],2)?> TL</span>
				<strong><?=$core->tr_date($l3)?></strong> | Biten Proje Tutarı | Toplam Ödeme
			</li>
			<?php 
			$total["proje"][2] = $sql->get_data("SELECT ROUND(SUM(fiyat), 2) AS toplam_fiyat FROM projeler WHERE bitis_tarih>'".$l2."' AND bitis_tarih<'".$l1."'");
			$total["odeme"][2] = $sql->get_data("SELECT ROUND(SUM(tutar), 2) AS toplam_odenen FROM odemeler WHERE odeme_tarihi>'".$l2."' AND odeme_tarihi<'".$l1."'");
			?>
			<li class="list-group-item">
				<span class="badge badge-success"><?=number_format($total["odeme"][2]["toplam_odenen"],2)?> TL</span>
				<span class="badge badge-warning"><?=number_format($total["proje"][2]["toplam_fiyat"],2)?> TL</span>
				<strong><?=$core->tr_date($l2)?></strong> | Biten Proje Tutarı | Toplam Ödeme
			</li>
			<?php 
			$total["proje"][3] = $sql->get_data("SELECT ROUND(SUM(fiyat), 2) AS toplam_fiyat FROM projeler WHERE bitis_tarih>'".$l1."' AND bitis_tarih<'".$l0."'");
			$total["odeme"][3] = $sql->get_data("SELECT ROUND(SUM(tutar), 2) AS toplam_odenen FROM odemeler WHERE odeme_tarihi>'".$l1."' AND odeme_tarihi<'".$l0."'");
			?>
			<li class="list-group-item">
				<span class="badge badge-success"><?=number_format($total["odeme"][3]["toplam_odenen"],2)?> TL</span>
				<span class="badge badge-warning"><?=number_format($total["proje"][3]["toplam_fiyat"],2)?> TL</span>
				<strong><?=$core->tr_date($l1)?></strong> | Biten Proje Tutarı | Toplam Ödeme
			</li>
			<?php 
			$total["proje"][4] = $sql->get_data("SELECT ROUND(SUM(fiyat), 2) AS toplam_fiyat FROM projeler WHERE bitis_tarih>='".$l0."'");
			$total["odeme"][4] = $sql->get_data("SELECT ROUND(SUM(tutar), 2) AS toplam_odenen FROM odemeler WHERE odeme_tarihi>='".$l0."'");
			?>
			<li class="list-group-item">
				<span class="badge badge-success"><?=number_format($total["odeme"][4]["toplam_odenen"],2)?> TL</span>
				<span class="badge badge-warning"><?=number_format($total["proje"][4]["toplam_fiyat"],2)?> TL</span>
				<strong><?=$core->tr_date($l0)?></strong> | Biten Proje Tutarı | Toplam Ödeme
			</li>
		</ul>
	</div>
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Tamamlanmayı Bekleyen Projeler</span>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Müşteri</th>
								<th>Proje Adı</th>
								<th>Proje Detay</th>
								<th>Başlama Tarihi</th>
								<th>Bitiş Tarihi</th>
								<th>Proje Durumu</th>
								<th align="right">Proje Tutarı</th>
								<th align="right">Ödenen Tutar</th>
								<th align="right">Kalan Tutar</th>
								<th align="right">Ödeme Durumu</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$cond = "p.proje_durum='0'";
							$order = " p.bitis_tarih ASC";
							$list_query = "SELECT p.*, m.ad_soyad AS musteri FROM projeler AS p
							LEFT JOIN musteriler AS m ON p.musteri_id=m.id
							WHERE $cond ORDER BY $order";
							$list_query = mysql_query($list_query);
							while($list = mysql_fetch_assoc($list_query)){
							?>
							<tr>
								<td><?=$list["musteri"]?></td>
								<td><?=$list["proje_ad"]?></td>
								<td><?=$list["proje_detay"]?></td>
								<td><?=$core->ndc($list["baslangic_tarih"])?></td>
								<td><?=$core->ndc($list["bitis_tarih"])?></td>
								<td><?=$proje_durum[$list["proje_durum"]]?></td>
								<td align="right"><?=number_format($list["fiyat"],2)?> TL</td>
								<td align="right"><?=number_format($list["odenen_tutar"],2)?> TL</td>
								<td align="right"><?=number_format($list["kalan_tutar"],2)?> TL</td>
								<td align="right"><?=$odeme_durum[$list["odeme_durum"]]?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>				
			</div>
		</div>
		
	</div>
</div>