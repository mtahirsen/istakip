<?php $ww = $_SESSION["screen_width"]; ?>
<ul>
	<li class="submenu"><a href="admin.php"><i class="icon-white icon-home"></i><span>Başlangıç</span></a></li>
	
	<?php if($admin->permission("personals.list",$online_admin["personal_group"])==1 || $admin->permission("personals_groups.list",$online_admin["personal_group"])==1){ ?>
	<li class="submenu">
		<a href="#"><i class="icon-white icon-user"></i><span>Personeller</span></a>
		<ul>
			<?php if($admin->permission("personals.list",$online_admin["personal_group"])==1){ ?> <li><a href="?s=display&dispatch=personals.list">Personel Listesi</a></li> <?php } ?>
			<?php if($admin->permission("personals.add",$online_admin["personal_group"])==1){ ?> <li><a href="?s=display&dispatch=personals.add">Yeni Personel Tanımla</a></li> <?php } ?>
			<?php if($admin->permission("personals_groups.list",$online_admin["personal_group"])==1){ ?> <li><a href="?s=display&dispatch=personals_groups.list">Personel Grupları Listesi</a></li> <?php } ?>
		</ul>
	</li>
	<?php } ?>
	
	<?php if($admin->permission("cars.list",$online_admin["personal_group"])==1 || $admin->permission("equipments.list",$online_admin["personal_group"])==1 || $admin->permission("machines.list",$online_admin["personal_group"])==1){ ?>
	<li class="submenu">
		<a href="#"><i class="icon-white icon-globe"></i><span>Araç / Ekipman / İş Makineleri</span></a>
		<ul style="width: 100%;">
			<?php if($admin->permission("cars.add",$online_admin["personal_group"])==1){ ?> <li><a href="?s=display&dispatch=cars.add">Araç Girişi</a></li> <?php } ?>
			<?php if($admin->permission("cars.list",$online_admin["personal_group"])==1){ ?> <li><a href="?s=display&dispatch=cars.list">Araç Listesi</a></li> <?php } ?>
			<?php if($admin->permission("equipments.add",$online_admin["personal_group"])==1){ ?> <li><a href="?s=display&dispatch=equipments.add">Ekipman Girişi</a></li> <?php } ?>
			<?php if($admin->permission("equipments.list",$online_admin["personal_group"])==1){ ?> <li><a href="?s=display&dispatch=equipments.list">Ekipman Listesi</a></li> <?php } ?>
			<?php if($admin->permission("machines.add",$online_admin["personal_group"])==1){ ?> <li><a href="?s=display&dispatch=machines.add">İş Makinesi Girişi</a></li> <?php } ?>
			<?php if($admin->permission("machines.list",$online_admin["personal_group"])==1){ ?> <li><a href="?s=display&dispatch=machines.list">İş Makinesi Listesi</a></li> <?php } ?>
		</ul>
	</li>
	<?php } ?>
	
	<?php if($admin->permission("fixtures.list",$online_admin["personal_group"])==1){ ?>
	<li class="submenu">
		<a href="#"><i class="icon-white icon-adjust"></i><span>Demirbaşlar</span> <?php if($count>0){ ?> <span class="balloon"><?=$count?></span> <?php } ?></a>
		<ul>
			<?php if($admin->permission("fixtures.add",$online_admin["personal_group"])==1){ ?> <li><a href="?s=display&dispatch=fixtures.add">Demirbaş Girişi</a></li> <?php } ?>
			<?php if($admin->permission("fixtures.list",$online_admin["personal_group"])==1){ ?> <li><a href="?s=display&dispatch=fixtures.list">Demirbaş Listesi</a></li> <?php } ?>
		</ul>
	</li>
	<?php } ?>
	
</ul>