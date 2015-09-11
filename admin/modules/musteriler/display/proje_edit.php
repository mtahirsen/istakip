<?php
$form->validator($empty2);
$data = $sql->get_row(MODULE_TABLE2,"*","WHERE id='".$_GET["id"]."'");
$data["baslangic_tarih"] = $core->ndc($data["baslangic_tarih"]);
$data["bitis_tarih"] = $core->ndc($data["bitis_tarih"]);
?>
<div class="page-header">
	<div class="row">
		<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa <?=MODULE_ICON2?> page-header-icon"></i>&nbsp;&nbsp; <?=MODULE_TITLE2?></h1>
		<div class="col-xs-12 col-sm-8">
			<div class="row">
				<hr class="visible-xs no-grid-gutter-h">
				<div class="pull-right col-xs-12 col-sm-auto"><a href="?s=display&dispatch=<?=MODULE_LINK?>.projeler&musteri_id=<?=$_GET["musteri_id"]?>" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-list-alt"></span>Listeye Dön</a></div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php include(MODULE_PROCESS_FOLDER."proje_edit.php"); ?>
		<form action="" method="POST" enctype="multipart/form-data">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title"><?=MODULE_KEY?> İşlemleri</span>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Proje Adı</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="proje_ad" placeholder="Proje Adı" value="<?=$data["proje_ad"]?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Proje Detay</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="proje_detay" placeholder="Proje Detay" value="<?=$data["proje_detay"]?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Başlangıç Tarihi</label>
					<div class="col-sm-10">
						<input type="text" class="form-control date-picker" name="baslangic_tarih" placeholder="Başlangıç Tarihi" value="<?=$data["baslangic_tarih"]?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Bitiş Tarihi (Termin)</label>
					<div class="col-sm-10">
						<input type="text" class="form-control date-picker" name="bitis_tarih" placeholder="Bitiş Tarihi (Termin)" value="<?=$data["bitis_tarih"]?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Proje Fiyatı</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="fiyat" placeholder="Proje Fiyatı" value="<?=$data["fiyat"]?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Proje Durumu</label>
					<div class="col-sm-10">
						<? $form->radio_button( array("name"=>"proje_durum", "type"=>"array", "source"=>$proje_durum, "checked"=>$data["proje_durum"]) ); ?>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="musteri_id" value="<?=$data["musteri_id"]?>">
		<button type="submit" class="btn btn-primary" style="width: 100%;">Formu Kaydet</button>
		</form>
	</div>
</div>