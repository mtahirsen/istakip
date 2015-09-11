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
				Toplam Müşteri
			</li>
			<li class="list-group-item">
				<span class="badge badge-warning"><?=mysql_num_rows(mysql_query("SELECT id FROM projeler"))?></span>
				Toplam Proje
			</li>
			<li class="list-group-item">
				<span class="badge badge-danger"><?=mysql_num_rows(mysql_query("SELECT id FROM projeler WHERE baslangic_tarih>='".date("Y-m-d", strtotime("1 ".date("M Y", time())))."'"))?></span>
				Bu Ay Başlanan Proje
			</li>
			<li class="list-group-item">
				<span class="badge badge-success"><?=mysql_num_rows(mysql_query("SELECT id FROM projeler WHERE bitis_tarih>='".date("Y-m-d", strtotime("1 ".date("M Y", time())))."'"))?></span>
				Bu Ay Biten Proje
			</li>
		</ul>
	</div>
	<div class="col-sm-4">
		<ul class="list-group">
			<?php $total = $sql->get_data("SELECT ROUND(SUM(fiyat), 2) AS toplam_fiyat FROM projeler"); ?>
			<li class="list-group-item">
				<span class="badge badge-info"><?=number_format($total["toplam_fiyat"],2)?> TL</span>
				Projelerin Toplam Tutarı
			</li>
			<?php $total = $sql->get_data("SELECT ROUND(SUM(tutar), 2) AS toplam_odenen FROM odemeler"); ?>
			<li class="list-group-item">
				<span class="badge badge-warning"><?=number_format($total["toplam_odenen"],2)?> TL</span>
				Alınan Ödeme Toplamı
			</li>
			<?php $total = $sql->get_data("SELECT ROUND(SUM(kalan_tutar), 2) AS toplam_kalan FROM projeler"); ?>
			<li class="list-group-item">
				<span class="badge badge-danger"><?=number_format($total["toplam_kalan"],2);?> TL</span>
				Toplam Alacak
			</li>
			<?php $total = $sql->get_data("SELECT ROUND(SUM(tutar), 2) AS ay_toplam_odenen FROM odemeler WHERE odeme_tarihi>='".date("Y-m-d", strtotime("1 ".date("M Y", time())))."'"); ?>
			<li class="list-group-item">
				<span class="badge badge-success"><?=number_format($total["ay_toplam_odenen"],2)?> TL</span>
				Bu Ay Alınan Ödeme Toplamı
			</li>
		</ul>
	</div>
	<div class="col-sm-5">
		<ul class="list-group">
			<?php
			$total_query = mysql_query("SELECT * FROM istatistikler ORDER BY ay_yil DESC LIMIT 0,4");
			while($total = mysql_fetch_assoc($total_query)){
			?>
			<li class="list-group-item">
				<span class="badge badge-success"><?=number_format($total["toplam_odenen_fiyat"],2)?> TL</span>
				<strong><?=$core->tr_date($total["ay_yil"])?></strong> | Alınan Ödeme Tutarı
			</li>
			<?php } ?>
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