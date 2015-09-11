<?php
$list_query = "SELECT admins.id, admins.username, admins.email, admins.name, admins.avatar, admins_groups.title AS group_title FROM admins
	LEFT JOIN admins_groups ON admins.group_id=admins_groups.id
	WHERE admins.id!='1'
";
$total = mysql_num_rows(mysql_query($list_query));
$pager->pager_set("?s=display&dispatch=".Module_Link.".list".$gets."&page=",$total,10,15,$_GET["page"],'class="active"',"«","»",'','','');
?>
<div class="page-header">
	<div class="row">
		<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa <?=Module_Icon?> page-header-icon"></i>&nbsp;&nbsp; <?=Module_Title?></h1>
		<div class="col-xs-12 col-sm-8">
			<div class="row">
				<hr class="visible-xs no-grid-gutter-h">
				<?php if($admin->permission(Module_Table.".add",$online_admin["group_id"])==1){ ?> <div class="pull-right col-xs-12 col-sm-auto"><a href="?s=display&dispatch=<?=Module_Link?>.add" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-plus"></span>Yeni <?=Module_Key?></a></div> <?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title"><?=Module_Key?> Listesi</span>
			</div>
			<div class="panel-body">
				<?php include(Module_Folder."/process/delete.php"); ?>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Kullanıcı Adı</th>
							<th>Adı Soyadı</th>
							<th>E-mail Adresi</th>
							<th>Yönetici Grubu</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$list_query = mysql_query($list_query." LIMIT ".$pager->start.", ".$pager->per_page."");
						while($list = mysql_fetch_assoc($list_query)){
						?>
						<tr>
							<td>
								<? if($list["avatar"]!=""){ ?><img src="<?=$list["avatar"]?>" alt="" width="25" height="25" class="avatar img-circle"> &nbsp;&nbsp; <?php } ?>
								<?=$list["username"]?>
							</td>
							<td><?=$list["name"]?></td>
							<td><?=$list["email"]?></td>
							<td><?=$list["group_title"]?></td>
							<td>
								<?php if(!in_array($list["id"],$master_admins)){ ?>
								<?php if($admin->permission(Module_Table.".edit",$online_admin["group_id"])==1){ ?> <a href="?s=display&dispatch=<?=Module_Link?>.edit&page=<?=$_GET["page"]?>&id=<?=$list["id"]?>" title="Kaydı Düzenle" class="btn btn-xs btn-outline btn-success add-tooltip"><i class="fa fa-pencil"></i></a> <?php } ?>
								<?php if($admin->permission(Module_Table.".delete",$online_admin["group_id"])==1){ ?> <a href="?s=display&dispatch=<?=Module_Link?>.list&page=<?=$_GET["page"]?>&delete=<?=$list["id"]?>" title="Kaydı Sil" class="btn btn-xs btn-outline btn-danger dialog-link"><i class="fa fa-times"></i></a> <?php } ?>
								<?php } ?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>		
			</div>
			<div class="panel-footer">
				<ul class="pagination">
					<?php		
					echo $pager->previous_page;
					echo $pager->page_links;
					echo $pager->next_page;
					?>
				</ul>
			</div>
		</div>
	</div>
</div>