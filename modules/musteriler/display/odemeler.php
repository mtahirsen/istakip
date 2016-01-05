<?php
if($_GET["order"]=="") $order = "o.id DESC"; else $order = $_GET["order"];

$cond = "WHERE o.id!='0'";
if($_GET["musteri_id"]) $cond .= " AND o.musteri_id='".$_GET["musteri_id"]."'";
if($_GET["proje_id"]) $cond .= " AND o.proje_id='".$_GET["proje_id"]."'";

$list_query = "SELECT o.*, m.ad_soyad AS musteri, p.proje_ad AS proje FROM odemeler AS o
LEFT JOIN musteriler AS m ON o.musteri_id=m.id
LEFT JOIN projeler AS p ON o.proje_id=p.id
$cond 
ORDER BY $order";

$total = mysql_num_rows(mysql_query($list_query));
$pager->pager_set("?s=display&dispatch=".MODULE_LINK.".odemeler".$gets."&page=",$total,10,15,$_GET["page"],'class="active"',"«","»",'','','');
?>
<div class="page-header">
	<div class="row">
		<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa <?=MODULE_ICON3?> page-header-icon"></i>&nbsp;&nbsp; <?=MODULE_TITLE3?></h1>
		<div class="col-xs-12 col-sm-8">
			<div class="row">
				<hr class="visible-xs no-grid-gutter-h">
				<?php if($admin->permission(MODULE_LINK.".odeme_add",$online_admin["group_id"])==1){ ?> <div class="pull-right col-xs-12 col-sm-auto"><a href="?s=display&dispatch=<?=MODULE_LINK?>.odeme_add&musteri_id=<?=$_GET["musteri_id"]?>&proje_id=<?=$_GET["proje_id"]?>" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-plus"></span>Yeni <?=MODULE_KEY3?></a></div> <?php } ?>
				<?php if($admin->permission(MODULE_LINK.".projeler",$online_admin["group_id"])==1){ ?> <div class="pull-right col-xs-12 col-sm-auto"><a href="?s=display&dispatch=<?=MODULE_LINK?>.projeler&musteri_id=<?=$_GET["musteri_id"]?>" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-list"></span>Projeler</a></div> <?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<form action="" method="post">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title"><?=MODULE_KEY?> Listesi</span>
			</div>
			<div class="panel-body">
				<?php include(MODULE_FOLDER."/process/odeme_delete.php"); ?>
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Müşteri</th>
								<th>Proje</th>
								<th>
									Ödeme Tarihi
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.odemeler<?=$gets?>&order=o.odeme_tarihi ASC"> <i class="fa fa-arrow-circle-up"></i> </a> 
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.odemeler<?=$gets?>&order=o.odeme_tarihi DESC"> <i class="fa fa-arrow-circle-down"></i> </a>
								</th>
								<th>
									Ödeme Tutarı
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.odemeler<?=$gets?>&order=o.tutar ASC"> <i class="fa fa-arrow-circle-up"></i> </a> 
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.odemeler<?=$gets?>&order=o.tutar DESC"> <i class="fa fa-arrow-circle-down"></i> </a>
								</th>
								<th>Ödeme Açıklama</th>
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
								<td><?=$list["proje"]?></td>
								<td><?=$core->ndc($list["odeme_tarihi"])?></td>
								<td><?=number_format($list["tutar"],2)?> TL</td>
								<td><?=$list["aciklama"]?></td>
								<td align="right">
									<?php if($admin->permission(MODULE_LINK.".odeme_edit",$online_admin["group_id"])==1){ ?> <a href="?s=display&dispatch=<?=MODULE_LINK?>.odeme_edit&page=<?=$_GET["page"]?>&id=<?=$list["id"]?>" title="Kaydı Düzenle" class="btn btn-xs btn-outline btn-success add-tooltip"><i class="fa fa-pencil"></i></a> <?php } ?>
									<?php if($admin->permission(MODULE_LINK.".odeme_delete",$online_admin["group_id"])==1){ ?> <a href="?s=display&dispatch=<?=MODULE_LINK?>.odemeler&page=<?=$_GET["page"]?>&delete=<?=$list["id"]?>" title="Kaydı Sil" class="btn btn-xs btn-outline btn-danger dialog-link"><i class="fa fa-times"></i></a> <?php } ?>
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