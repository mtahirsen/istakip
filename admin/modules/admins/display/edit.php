<?php
$data = $core->get_row(Module_Table,"*","WHERE id='".$_GET["id"]."'");
?>
<div class="page-header">
	<div class="row">
		<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa <?=Module_Icon?> page-header-icon"></i>&nbsp;&nbsp; <?=Module_Title?></h1>
		<div class="col-xs-12 col-sm-8">
			<div class="row">
				<hr class="visible-xs no-grid-gutter-h">
				<div class="pull-right col-xs-12 col-sm-auto"><a href="?s=display&dispatch=<?=Module_Link?>.list" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-list-alt"></span>Listeye Dön</a></div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title"><?=Module_Key?> İşlemleri</span>
			</div>
			<div class="panel-body">
				<?php include(Module_Folder."/process/edit.php"); ?>
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-2 control-label">Yönetici Grubu</label>
						<div class="col-sm-10">
							<select name="group_id" class="form-control select2">
								<?php
								$group_query = mysql_query("SELECT * FROM admins_groups");
								while($group = mysql_fetch_assoc($group_query)){
								?>
								<option value="<?=$group["id"]?>" <? if($data["group_id"]==$group["id"]) echo 'selected="selected"'; ?>><?=$group["title"]?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Kullanıcı Adı</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="username" placeholder="Kullanıcı Adı" value="<?=$data["username"]?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Şifre</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="new_password" placeholder="Şifre" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Adı Soyadı</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="name" placeholder="Adı Soyadı" value="<?=$data["name"]?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Email Adresi</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="email" placeholder="Email Adresi" value="<?=$data["email"]?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Avatar</label>
						<div class="col-sm-6">
							<input type="file" class="file-input" name="image" accept="image/*" />
						</div>
						<div class="col-sm-4">
							<?php if($data["avatar"]!=""){ ?>
							<a rel="prettyPhoto" href="<?=$data["avatar"]?>" class="btn btn-info">Resimi Gör</a>
							<a href="?s=display&dispatch=<?=Module_Link?>.edit&page=&id=<?=$_GET["id"]?>&delete_image=1" class="btn btn-danger dialog-link">Resimi Sil</a>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Panel Teması</label>
						<div class="col-sm-10">
							<div class="radio-inline">
								<label>
									<input type="radio" name="theme" value="default" class="px" <? if($data["theme"]=="default") echo 'checked="checked"';?>>
									<span class="lbl"><img src="admin/assets/demo/themes/default.png" style="width: 100px;" alt=""></span>
								</label>
							</div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="theme" value="adminflare" class="px" <? if($data["theme"]=="adminflare") echo 'checked="checked"';?>>
									<span class="lbl"><img src="admin/assets/demo/themes/adminflare.png" style="width: 100px;" alt=""></span>
								</label>
							</div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="theme" value="asphalt" class="px" <? if($data["theme"]=="asphalt") echo 'checked="checked"';?>>
									<span class="lbl"><img src="admin/assets/demo/themes/asphalt.png" style="width: 100px;" alt=""></span>
								</label>
							</div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="theme" value="clean" class="px" <? if($data["theme"]=="clean") echo 'checked="checked"';?>>
									<span class="lbl"><img src="admin/assets/demo/themes/clean.png" style="width: 100px;" alt=""></span>
								</label>
							</div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="theme" value="dust" class="px" <? if($data["theme"]=="dust") echo 'checked="checked"';?>>
									<span class="lbl"><img src="admin/assets/demo/themes/dust.png" style="width: 100px;" alt=""></span>
								</label>
							</div>
							<div class="clearfix"></div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="theme" value="fresh" class="px" <? if($data["theme"]=="fresh") echo 'checked="checked"';?>>
									<span class="lbl"><img src="admin/assets/demo/themes/fresh.png" style="width: 100px;" alt=""></span>
								</label>
							</div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="theme" value="frost" class="px" <? if($data["theme"]=="frost") echo 'checked="checked"';?>>
									<span class="lbl"><img src="admin/assets/demo/themes/frost.png" style="width: 100px;" alt=""></span>
								</label>
							</div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="theme" value="purple-hills" class="px" <? if($data["theme"]=="purple-hills") echo 'checked="checked"';?>>
									<span class="lbl"><img src="admin/assets/demo/themes/purple-hills.png" style="width: 100px;" alt=""></span>
								</label>
							</div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="theme" value="silver" class="px" <? if($data["theme"]=="silver") echo 'checked="checked"';?>>
									<span class="lbl"><img src="admin/assets/demo/themes/silver.png" style="width: 100px;" alt=""></span>
								</label>
							</div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="theme" value="white" class="px" <? if($data["theme"]=="white") echo 'checked="checked""';?>>
									<span class="lbl"><img src="admin/assets/demo/themes/white.png" style="width: 100px;" alt=""></span>
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Diğer Seçenekler</label>
						<div class="col-sm-10">
							<div class="checkbox-inline">
								<input type="hidden" name="fixed_top_menu" value="0">
								<label><input type="checkbox" class="px" name="fixed_top_menu" value="1" <? if($data["fixed_top_menu"]==1) echo 'checked="checked"'; ?>> <span class="lbl">Üst Menü Sabit</span></label>
							</div>
							<div class="checkbox-inline">
								<input type="hidden" name="fixed_left_menu" value="0">
								<label><input type="checkbox" class="px" name="fixed_left_menu" value="1" <? if($data["fixed_left_menu"]==1) echo 'checked="checked"'; ?>> <span class="lbl">Sol Menü Sabit</span></label>
							</div>
						</div>
					</div>
					<div class="form-group" style="margin-bottom: 0;">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="hidden" name="password" value="<?=$data["password"]?>" />
							<button type="submit" class="btn btn-primary">Formu Kaydet</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
