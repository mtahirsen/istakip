<div class="panel">
	<div class="panel-body">
		<form action="" method="get">
			<input type="hidden" name="s" value="display" />
			<input type="hidden" name="dispatch" value="<?=MODULE_LINK?>.list" />
			<input type="hidden" name="order" value="<?=$_GET["order"]?>" />
			<div class="row">
				<div class="col-md-2">
					<input name="ad_soyad" type="text" class="form-control" placeholder="Adı Soyadı" value="<?=$_GET["ad_soyad"]?>" />
				</div>
				<div class="col-md-2">
					<input name="firma" type="text" class="form-control" placeholder="Firma" value="<?=$_GET["firma"]?>" />
				</div>
				<!-- div class="col-md-2">
					<select name="stok" class="select2 form-control">
						<option value="">Stok</option>
						<?php
						$group_query = mysql_query("SELECT * FROM stoklar");
						while($group = mysql_fetch_assoc($group_query)){
						?>
						<option value="<?=$group["id"]?>" <? if($_GET["stok"]==$group["id"]) echo 'selected="selected"'; ?>><?=$group["uretim_kodu"]?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-2">
					<select name="marka" class="select2 form-control">
						<option value="">Marka</option>
						<?php
						$group_query = mysql_query("SELECT * FROM markalar");
						while($group = mysql_fetch_assoc($group_query)){
						?>
						<option value="<?=$group["id"]?>" <? if($_GET["marka"]==$group["id"]) echo 'selected="selected"'; ?>><?=$group["marka_adi"]?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-3">
					<div class="input-daterange input-group" id="bs-datepicker-range">
						<input name="date_1" type="text" class="form-control date-picker" placeholder="Başlangıç" value="<?=$_GET["date_1"]?>">
						<span class="input-group-addon"><></span>
						<input name="date_2" type="text" class="form-control date-picker" placeholder="Bitiş" value="<?=$_GET["date_2"]?>">
					</div>
				</div -->
				<div class="col-md-auto">
					<input type="hidden" name="search" value="1">
					<button type="submit" class="btn btn-labeled"><span class="btn-label icon fa fa-search"></span>Arama Yap</button>
					<?php if($_GET["search"]){ ?> 
					<a class="btn btn-labeled btn-danger" href="?s=display&dispatch=<?=MODULE_LINK?>.list"><span class="btn-label icon fa fa-reply"></span>Aramayı Temizle</a>
					<?php } ?>
				</div>
			</div>
		</form>
	</div>
</div>