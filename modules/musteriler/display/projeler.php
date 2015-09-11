<?php
$cond = "p.id!='0'";
$cond .= " AND p.musteri_id='".$_SESSION["client_id"]."'";

if($_GET["order"]=="") $order = "p.id DESC"; else $order = $_GET["order"];

$list_query = "SELECT p.*, m.ad_soyad AS musteri FROM projeler AS p
LEFT JOIN musteriler AS m ON p.musteri_id=m.id
WHERE $cond ORDER BY $order";

$gets = "&musteri_id=".$_GET["musteri_id"];

$total = mysql_num_rows(mysql_query($list_query));
$pager->pager_set("?s=display&dispatch=".MODULE_LINK.".isler".$gets."&page=",$total,10,15,$_GET["page"],'class="active"',"«","»",'','','');
?>
<div class="page-header">
	<div class="row">
		<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa <?=MODULE_ICON2?> page-header-icon"></i>&nbsp;&nbsp; <?=MODULE_TITLE2?></h1>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<form action="" method="post">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title"><?=MODULE_KEY2?> Listesi</span>
			</div>
			<div class="panel-body">
				<?php include(MODULE_FOLDER."/process/proje_delete.php"); ?>
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Müşteri</th>
								<th>Proje Adı</th>
								<th>Proje Detay</th>
								<th>
									Başlama Tarihi
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.projeler<?=$gets?>&order=p.baslangic_tarih ASC"> <i class="fa fa-arrow-circle-up"></i> </a> 
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.projeler<?=$gets?>&order=p.baslangic_tarih DESC"> <i class="fa fa-arrow-circle-down"></i> </a>
								</th>
								<th>Bitiş Tarihi</th>
								<th>
									Proje Durumu
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.projeler<?=$gets?>&order=p.proje_durum ASC"> <i class="fa fa-arrow-circle-up"></i> </a> 
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.projeler<?=$gets?>&order=p.proje_durum DESC"> <i class="fa fa-arrow-circle-down"></i> </a>
								</th>
								<th align="right">
									Proje Tutarı
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.projeler<?=$gets?>&order=p.fiyat ASC"> <i class="fa fa-arrow-circle-up"></i> </a> 
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.projeler<?=$gets?>&order=p.fiyat DESC"> <i class="fa fa-arrow-circle-down"></i> </a>
								</th>
								<th align="right">
									Ödenen Tutar
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.projeler<?=$gets?>&order=p.odenen_tutar ASC"> <i class="fa fa-arrow-circle-up"></i> </a> 
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.projeler<?=$gets?>&order=p.odenen_tutar DESC"> <i class="fa fa-arrow-circle-down"></i> </a>
								</th>
								<th align="right">
									Kalan Tutar
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.projeler<?=$gets?>&order=p.kalan_tutar ASC"> <i class="fa fa-arrow-circle-up"></i> </a> 
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.projeler<?=$gets?>&order=p.kalan_tutar DESC"> <i class="fa fa-arrow-circle-down"></i> </a>
								</th>
								<th align="right">
									Ödeme Durumu
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.projeler<?=$gets?>&order=p.odeme_durum ASC"> <i class="fa fa-arrow-circle-up"></i> </a> 
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.projeler<?=$gets?>&order=p.odeme_durum DESC"> <i class="fa fa-arrow-circle-down"></i> </a>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$list_query = mysql_query($list_query." LIMIT ".$pager->start.", ".$pager->per_page."");
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
			<div class="panel-footer">
				<div class="col-md-8">
				<ul class="pagination">
					<?php		
					echo $pager->previous_page;
					echo $pager->page_links;
					echo $pager->next_page;
					?>
				</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		</form>
	</div>
</div>