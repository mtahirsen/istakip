<?php
$form->validator($empty3);
$data = $sql->get_row(MODULE_TABLE3,"*","WHERE id='".$_GET["id"]."'");
$data["odeme_tarihi"] = $core->ndc($data["odeme_tarihi"]);
?>
<div class="page-header">
	<div class="row">
		<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa <?=MODULE_ICON3?> page-header-icon"></i>&nbsp;&nbsp; <?=MODULE_TITLE3?></h1>
		<div class="col-xs-12 col-sm-8">
			<div class="row">
				<hr class="visible-xs no-grid-gutter-h">
				<div class="pull-right col-xs-12 col-sm-auto"><a href="?s=display&dispatch=<?=MODULE_LINK?>.odemeler&proje_id=<?=$data["proje_id"]?>&musteri_id=<?=$data["musteri_id"]?>" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-list-alt"></span>Listeye Dön</a></div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php include(MODULE_PROCESS_FOLDER."odeme_edit.php"); ?>
		<form action="" method="POST" enctype="multipart/form-data">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title"><?=MODULE_KEY?> İşlemleri</span>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Ödeme Tarihi</label>
					<div class="col-sm-10">
						<input type="text" class="form-control date-picker" name="odeme_tarihi" placeholder="Ödeme Tarihi" value="<?=$data["odeme_tarihi"]?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Ödenen Tutar</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="tutar" placeholder="Ödenen Tutar" value="<?=$data["tutar"]?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Ödeme Açıklama</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="aciklama" placeholder="Ödeme Açıklama" value="<?=$data["aciklama"]?>">
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="musteri_id" value="<?=$data["musteri_id"]?>">
		<input type="hidden" name="proje_id" value="<?=$data["proje_id"]?>">
		<button type="submit" class="btn btn-primary" style="width: 100%;">Formu Kaydet</button>
		</form>
	</div>
</div>