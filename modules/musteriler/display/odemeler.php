<?php
if($_GET["order"]=="") $order = "id DESC"; else $order = $_GET["order"];

$cond = "WHERE id!='0'";
$cond .= " AND musteri_id='".$_SESSION["client_id"]."'";
if($_GET["proje_id"]) $cond .= " AND proje_id='".$_GET["proje_id"]."'";

$list_query = "SELECT * FROM ".MODULE_TABLE3." $cond ORDER BY $order";

$total = mysql_num_rows(mysql_query($list_query));
$pager->pager_set("?s=display&dispatch=".MODULE_LINK.".odemeler".$gets."&page=",$total,10,15,$_GET["page"],'class="active"',"«","»",'','','');
?>
<div class="page-header">
	<div class="row">
		<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa <?=MODULE_ICON3?> page-header-icon"></i>&nbsp;&nbsp; <?=MODULE_TITLE3?></h1>
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
								<th>Proje</th>
								<th>
									Ödeme Tarihi
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.odemeler<?=$gets?>&order=odeme_tarihi ASC"> <i class="fa fa-arrow-circle-up"></i> </a> 
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.odemeler<?=$gets?>&order=odeme_tarihi DESC"> <i class="fa fa-arrow-circle-down"></i> </a>
								</th>
								<th>
									Ödeme Tutarı
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.odemeler<?=$gets?>&order=tutar ASC"> <i class="fa fa-arrow-circle-up"></i> </a> 
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.odemeler<?=$gets?>&order=tutar DESC"> <i class="fa fa-arrow-circle-down"></i> </a>
								</th>
								<th>Ödeme Açıklama</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$list_query = mysql_query($list_query." LIMIT ".$pager->start.", ".$pager->per_page."");
							while($list = mysql_fetch_assoc($list_query)){
								$proje = $sql->get_row("projeler","*","WHERE id='".$list["proje_id"]."'");
							?>
							<tr>
								<td><?=$proje["proje_ad"]?></td>
								<td><?=$core->ndc($list["odeme_tarihi"])?></td>
								<td><?=number_format($list["tutar"],2)?> TL</td>
								<td><?=$list["aciklama"]?></td>
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