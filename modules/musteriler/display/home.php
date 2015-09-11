<div class="page-header">
	<div class="row">
		<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-file page-header-icon"></i>&nbsp;&nbsp; Genel Durum</h1>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<ul class="list-group">
			<li class="list-group-item">
				<span class="badge badge-warning"><?=mysql_num_rows(mysql_query("SELECT id FROM projeler WHERE musteri_id='".$_SESSION["client_id"]."'"))?></span>
				Toplam Proje Sayısı
			</li>
			<li class="list-group-item">
				<span class="badge badge-danger"><?=mysql_num_rows(mysql_query("SELECT id FROM projeler WHERE musteri_id='".$_SESSION["client_id"]."' AND baslangic_tarih>='".date("Y-m-d", strtotime("1 ".date("M Y", time())))."'"))?></span>
				Bu Ay Başlanan Proje Sayısı
			</li>
			<li class="list-group-item">
				<span class="badge badge-success"><?=mysql_num_rows(mysql_query("SELECT id FROM projeler WHERE musteri_id='".$_SESSION["client_id"]."' AND bitis_tarih>='".date("Y-m-d", strtotime("1 ".date("M Y", time())))."'"))?></span>
				Bu Ay Biten Proje Sayısı
			</li>
		</ul>
	</div>
	<div class="col-sm-6">
		<ul class="list-group">
			<?php $total = $sql->get_data("SELECT ROUND(SUM(fiyat), 2) AS toplam_fiyat FROM projeler WHERE musteri_id='".$_SESSION["client_id"]."'"); ?>
			<li class="list-group-item">
				<span class="badge badge-info"><?=number_format($total["toplam_fiyat"],2)?> TL</span>
				Projelerin Toplam Fiyatı
			</li>
			<?php $total = $sql->get_data("SELECT ROUND(SUM(tutar), 2) AS toplam_odenen FROM odemeler WHERE musteri_id='".$_SESSION["client_id"]."'"); ?>
			<li class="list-group-item">
				<span class="badge badge-warning"><?=number_format($total["toplam_odenen"],2)?> TL</span>
				Toplam Ödenen Tutar
			</li>
			<?php $total = $sql->get_data("SELECT ROUND(SUM(kalan_tutar), 2) AS toplam_kalan FROM projeler WHERE musteri_id='".$_SESSION["client_id"]."'"); ?>
			<li class="list-group-item">
				<span class="badge badge-danger"><?=number_format($total["toplam_kalan"],2);?> TL</span>
				Toplam Kalan Borç
			</li>
		</ul>
	</div>
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Aktif Projeler</span>
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
							$cond = "p.proje_durum='0' AND p.musteri_id='".$_SESSION["client_id"]."'";
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
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Tamamlanmayı Bekleyen Ödemeler</span>
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
							</tr>
						</thead>
						<tbody>
							<?php
							$total_kalan = 0;
							$cond = "p.kalan_tutar>'0' AND p.musteri_id='".$_SESSION["client_id"]."'";
							$order = " p.bitis_tarih ASC";
							$list_query = "SELECT p.*, m.ad_soyad AS musteri FROM projeler AS p
							LEFT JOIN musteriler AS m ON p.musteri_id=m.id
							WHERE $cond ORDER BY $order";
							$list_query = mysql_query($list_query);
							while($list = mysql_fetch_assoc($list_query)){
								$total_kalan += $list["kalan_tutar"];
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
								<td align="right"><div style="color:red; font-weight: bold;"><?=number_format($list["kalan_tutar"],2)?> TL</div></td>
							</tr>
							<?php } ?>
							<tr>
								<td colspan="8"></td>
								<td align="right"><div style="color:red; font-weight: bold;"><?=number_format($total_kalan,2)?> TL</div></td>
							</tr>
						</tbody>
					</table>
				</div>				
			</div>
		</div>
		
	</div>
</div>