<?php
if($_GET["order"]=="") $order = "id DESC"; else $order = $_GET["order"];

$cond = "WHERE id!='0'";
if($_GET["ad_soyad"]!="") $cond .= " AND ad_soyad LIKE '%".$_GET["ad_soyad"]."%'";
if($_GET["firma"]!="") $cond .= " AND firma LIKE '%".$_GET["firma"]."%'";

$gets = "&search=".$_REQUEST["search"];
$gets .= "&firma=".$_REQUEST["firma"];
$gets .= "&ad_soyad=".$_REQUEST["ad_soyad"];
$gets .= "&order=".$_REQUEST["order"];

$list_query = "SELECT * FROM ".MODULE_TABLE." $cond ORDER BY $order";

$total = mysql_num_rows(mysql_query($list_query));
$pager->pager_set("?s=display&dispatch=".MODULE_LINK.".list".$gets."&page=",$total,10,15,$_GET["page"],'class="active"',"«","»",'','','');
?>
<div class="page-header">
	<div class="row">
		<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa <?=MODULE_ICON?> page-header-icon"></i>&nbsp;&nbsp; <?=MODULE_TITLE?></h1>
		<div class="col-xs-12 col-sm-8">
			<div class="row">
				<hr class="visible-xs no-grid-gutter-h">
				<?php if($admin->permission(MODULE_TABLE.".add",$online_admin["group_id"])==1){ ?> <div class="pull-right col-xs-12 col-sm-auto"><a href="?s=display&dispatch=<?=MODULE_LINK?>.add" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-plus"></span>Yeni <?=MODULE_KEY?></a></div> <?php } ?>
				<div class="pull-right col-xs-12 col-sm-auto"><a data-toggle="collapse" data-target=".row.search" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-search"></span><?=MODULE_KEY?> Arama</a></div>
			</div>
		</div>
	</div>
</div>
<div class="row search collapse <? if($_GET["search"]) echo 'in'; ?>">
	<div class="col-md-12">
		<?php include(MODULE_FOLDER."/display/list_search.php"); ?>
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
				<?php include(MODULE_FOLDER."/process/delete.php"); ?>
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Adı Soyadı</th>
								<th>Firması</th>
								<th>Email Adresi</th>
								<th>Telefonu</th>
								<th align="right">
									Proje Tutarı 
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.list<?=$gets?>&order=proje_toplam ASC"> <i class="fa fa-arrow-circle-up"></i> </a> 
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.list<?=$gets?>&order=proje_toplam DESC"> <i class="fa fa-arrow-circle-down"></i> </a>
								</th>
								<th align="right">
									Ödenen Tutar
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.list<?=$gets?>&order=toplam_odeme ASC"> <i class="fa fa-arrow-circle-up"></i> </a> 
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.list<?=$gets?>&order=toplam_odeme DESC"> <i class="fa fa-arrow-circle-down"></i> </a>
								</th>
								<th align="right">
									Kalan Borç
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.list<?=$gets?>&order=toplam_borc ASC"> <i class="fa fa-arrow-circle-up"></i> </a> 
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.list<?=$gets?>&order=toplam_borc DESC"> <i class="fa fa-arrow-circle-down"></i> </a>
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
								<td><?=$list["ad_soyad"]?></td>
								<td><?=$list["firma"]?></td>
								<td><?=$list["email"]?></td>
								<td><?=$list["telefon"]?></td>
								<td align="right"><span class="badge badge-info"><?=number_format($list["proje_toplam"],2)?> TL</span></td>
								<td align="right"><span class="badge badge-success"><?=number_format($list["toplam_odeme"],2)?> TL</span></td>
								<td align="right"><span class="badge badge-danger"><?=number_format($list["toplam_borc"],2)?> TL</span></td>
								<td align="right">
									<?php if($admin->permission(MODULE_LINK.".projeler",$online_admin["group_id"])==1){ ?> <a href="?s=display&dispatch=<?=MODULE_LINK?>.odemeler&page=<?=$_GET["page"]?>&musteri_id=<?=$list["id"]?>" title="Ödemeler" class="btn btn-xs btn-outline btn-success add-tooltip"><i class="fa fa-dollar"></i></a> <?php } ?>
									<?php if($admin->permission(MODULE_LINK.".projeler",$online_admin["group_id"])==1){ ?> <a href="?s=display&dispatch=<?=MODULE_LINK?>.projeler&page=<?=$_GET["page"]?>&musteri_id=<?=$list["id"]?>" title="Projeler" class="btn btn-xs btn-outline btn-success add-tooltip"><i class="fa fa-archive"></i></a> <?php } ?>
									<?php if($admin->permission(MODULE_LINK.".edit",$online_admin["group_id"])==1){ ?> <a href="?s=display&dispatch=<?=MODULE_LINK?>.edit&page=<?=$_GET["page"]?>&id=<?=$list["id"]?>" title="Kaydı Düzenle" class="btn btn-xs btn-outline btn-success add-tooltip"><i class="fa fa-pencil"></i></a> <?php } ?>
									<?php if($admin->permission(MODULE_LINK.".delete",$online_admin["group_id"])==1){ ?> <a href="?s=display&dispatch=<?=MODULE_LINK?>.list&page=<?=$_GET["page"]?>&delete=<?=$list["id"]?>" title="Kaydı Sil" class="btn btn-xs btn-outline btn-danger dialog-link"><i class="fa fa-times"></i></a> <?php } ?>
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