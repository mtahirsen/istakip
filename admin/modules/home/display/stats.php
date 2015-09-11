<?php
$months = array(
	1 => "Ocak",
	2 => "Şubat",
	3 => "Mart",
	4 => "Nisan",
	5 => "Mayıs",
	6 => "Haziran",
	7 => "Temmuz",
	8 => "Ağustos",
	9 => "Eylül",
	10 => "Ekim",
	11 => "Kasım",
	12 => "Aralık",
);
?>

<div class="page-header">
	<div class="row">
		<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-file page-header-icon"></i>&nbsp;&nbsp; İstatistik Robotu</h1>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="panel">
			<div class="panel-body">
				<form action="" method="post">
					<input type="hidden" name="s" value="display" />
					<input type="hidden" name="dispatch" value="<?=MODULE_LINK?>.list" />
					<input type="hidden" name="order" value="<?=$_GET["order"]?>" />
					<div class="row">
						<div class="col-md-2">
							<input name="date1" type="text" class="form-control" placeholder="Tarih 1" value="<?=$_REQUEST["date1"]?>" />
						</div>
						<div class="col-md-auto">
							<input type="hidden" name="search" value="1">
							<button type="submit" class="btn btn-labeled"><span class="btn-label icon fa fa-search"></span>İstatistik Güncelle</button>
							<?php if($_GET["search"]){ ?> 
							<a class="btn btn-labeled btn-danger" href="?s=display&dispatch=<?=MODULE_LINK?>.list"><span class="btn-label icon fa fa-reply"></span>Aramayı Temizle</a>
							<?php } ?>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php if($_POST){ ?>
<div class="row">
	<div class="col-sm-12">
		<?php $site->istatistik_olustur($_POST["date1"],$_POST["date2"]); ?>
	</div>
</div>
<?php } ?>


<?php
$yil_query = mysql_query("SELECT yil, ROUND(SUM(toplam_odenen_fiyat),2) AS total FROM istatistikler GROUP BY yil ORDER BY yil DESC");
while($yil = mysql_fetch_assoc($yil_query)){
	$total_basp = 0;
	$total_bitp = 0;
	$total_odenen = 0;
?>
<div class="row">
	<div class="col-md-12">
		<form action="" method="post">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title"><?=$yil["yil"]?> İstatistikleri</span>
			</div>
			<div class="panel-body">
				<?php include(MODULE_FOLDER."/process/delete.php"); ?>
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Yıl / Ay</th>
								<th>Başlanan Proje</th>
								<th>Biten Proje</th>
								<th align="right">
									Baş. Proje T.T.
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.list<?=$gets?>&order=proje_toplam ASC"> <i class="fa fa-arrow-circle-up"></i> </a> 
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.list<?=$gets?>&order=proje_toplam DESC"> <i class="fa fa-arrow-circle-down"></i> </a>
								</th>
								<th align="right">
									Bit. Proje T.T.
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.list<?=$gets?>&order=toplam_odeme ASC"> <i class="fa fa-arrow-circle-up"></i> </a> 
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.list<?=$gets?>&order=toplam_odeme DESC"> <i class="fa fa-arrow-circle-down"></i> </a>
								</th>
								<th align="right">
									Alınan Ödemem
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.list<?=$gets?>&order=toplam_borc ASC"> <i class="fa fa-arrow-circle-up"></i> </a> 
									<a class="order" href="?s=display&dispatch=<?=MODULE_LINK?>.list<?=$gets?>&order=toplam_borc DESC"> <i class="fa fa-arrow-circle-down"></i> </a>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$list_query = "SELECT * FROM istatistikler WHERE yil='".$yil["yil"]."' ORDER BY ay,yil DESC";
							$list_query = mysql_query($list_query);
							while($list = mysql_fetch_assoc($list_query)){
								$total_basp += $list["baslanan_proje_toplam_fiyat"];
								$total_bitp += $list["biten_proje_toplam_fiyat"];
								$total_odenen += $list["toplam_odenen_fiyat"];
								mysql_query("update istatistikler set ay_yil='".($list["yil"]."-".$list["ay"]."-01")."' where id='".$list["id"]."'");
							?>
							<tr>
								<td><?=$list["yil"]?> <?=$months[$list["ay"]]?></td>
								<td><?=$list["baslanan_proje"]?></td>
								<td><?=$list["biten_proje"]?></td>
								<td align="right"><span class="badge badge-info"><?=number_format($list["baslanan_proje_toplam_fiyat"],2)?> TL</span></td>
								<td align="right"><span class="badge badge-warning"><?=number_format($list["biten_proje_toplam_fiyat"],2)?> TL</span></td>
								<td align="right"><span class="badge badge-success"><?=number_format($list["toplam_odenen_fiyat"],2)?> TL</span></td>
							</tr>
							<?php } ?>
							<tr>
								<td colspan="3"></td>
								<td align="right"><strong><?=number_format($total_basp,2)?> TL</strong></td>
								<td align="right"><strong><?=number_format($total_bitp,2)?> TL</strong></td>
								<td align="right"><strong><?=number_format($total_odenen,2)?> TL</strong></td>
							</tr>
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
<?php } ?>