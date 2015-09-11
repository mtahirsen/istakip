<?php
$form->validator($empty);
$data = $sql->get_row(MODULE_TABLE,"*","WHERE id='".$_GET["id"]."'");
?>
<div class="page-header">
	<div class="row">
		<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa <?=MODULE_ICON?> page-header-icon"></i>&nbsp;&nbsp; <?=MODULE_TITLE?></h1>
		<div class="col-xs-12 col-sm-8">
			<div class="row">
				<hr class="visible-xs no-grid-gutter-h">
				<div class="pull-right col-xs-12 col-sm-auto"><a href="?s=display&dispatch=<?=MODULE_LINK?>.list" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-list-alt"></span>Listeye Dön</a></div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php include(MODULE_PROCESS_FOLDER."edit.php"); ?>
		<form action="" method="POST" enctype="multipart/form-data">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title"><?=MODULE_KEY?> İşlemleri</span>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Adı Soyadı</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="ad_soyad" placeholder="Adı Soyadı" value="<?=$data["ad_soyad"]?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Firma</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="firma" placeholder="Firma" value="<?=$data["firma"]?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="email" placeholder="Email" value="<?=$data["email"]?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Telefon</label>
					<div class="col-sm-10">
						<input type="text" class="form-control phone" name="telefon" placeholder="Telefon" value="<?=$data["telefon"]?>">
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label class="col-sm-2 control-label">Kullanıcı Adı</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="kullanici_adi" placeholder="Kullanıcı Adı" value="<?=$data["kullanici_adi"]?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Şifre</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="sifre" placeholder="Şifre" value="<?=$data["sifre"]?>">
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="date" value="<?=date("Y-m-d")?>">
		<button type="submit" class="btn btn-primary" style="width: 100%;">Formu Kaydet</button>
		</form>
	</div>
</div>