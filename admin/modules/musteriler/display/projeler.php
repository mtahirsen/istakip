<?php
$cond = "p.id!='0'";
if($_GET["musteri_id"]) $cond .= " AND p.musteri_id='".$_GET["musteri_id"]."'";

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
		<div class="col-xs-12 col-sm-8">
			<div class="row">
				<hr class="visible-xs no-grid-gutter-h">
				<?php if($admin->permission(MODULE_LINK.".proje_add",$online_admin["group_id"])==1){ ?> <div class="pull-right col-xs-12 col-sm-auto"><a href="?s=display&dispatch=<?=MODULE_LINK?>.proje_add&musteri_id=<?=$_GET["musteri_id"]?>" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-plus"></span>Yeni <?=MODULE_KEY2?></a></div> <?php } ?>
				<?php if($admin->permission(MODULE_LINK.".list",$online_admin["group_id"])==1){ ?> <div class="pull-right col-xs-12 col-sm-auto"><a href="?s=display&dispatch=<?=MODULE_LINK?>.list" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-list"></span>Müşteriler</a></div> <?php } ?>
			</div>
		</div>
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
								<th></th>
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
								<td align="right">
									<?php if($admin->permission(MODULE_LINK.".odemeler",$online_admin["group_id"])==1){ ?> <a href="?s=display&dispatch=<?=MODULE_LINK?>.odemeler&page=<?=$_GET["page"]?>&musteri_id=<?=$list["musteri_id"]?>&proje_id=<?=$list["id"]?>" title="Ödeme Takip" class="btn btn-xs btn-outline btn-success add-tooltip"><i class="fa fa-dollar"></i></a> <?php } ?>
									<?php if($admin->permission(MODULE_LINK.".proje_edit",$online_admin["group_id"])==1){ ?> <a href="?s=display&dispatch=<?=MODULE_LINK?>.proje_edit&page=<?=$_GET["page"]?>&id=<?=$list["id"]?>" title="Kaydı Düzenle" class="btn btn-xs btn-outline btn-success add-tooltip"><i class="fa fa-pencil"></i></a> <?php } ?>
									<?php if($admin->permission(MODULE_LINK.".proje_delete",$online_admin["group_id"])==1){ ?> <a href="?s=display&dispatch=<?=MODULE_LINK?>.projeler&page=<?=$_GET["page"]?>&delete=<?=$list["id"]?>" title="Kaydı Sil" class="btn btn-xs btn-outline btn-danger dialog-link"><i class="fa fa-times"></i></a> <?php } ?>
								</td>
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