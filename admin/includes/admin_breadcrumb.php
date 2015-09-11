<?php
$dispatch = explode('.',$_GET["dispatch"]);
$module = $dispatch[0];
$file = $dispatch[1];
?>
<ul class="breadcrumb">
	<?php if($module=="" && $file==""){ ?>
		<li><a href="admin.php"><i class="icon icon-home"></i><span class="text">Başlangıç</span></a></li>
	<?php }else{ ?>
		<li><a href="admin.php"><i class="icon icon-home"></i><span class="text">Başlangıç</span></a> <span class="divider"><div class="icon icon-chevron-right"></div></span></li>
		<?php if($file=="list"){ ?>
			<li class="active"><?=$modules[$module]["title"]?></li>
		<?php }elseif($file=="add"){ ?>
			<li><a href="?s=display&dispatch=<?=$module?>.list"><?=$modules[$module]["title"]?></a> <span class="divider"><div class="icon icon-chevron-right"></div></span></li>
			<li class="active">Yeni <?=$modules[$module]["key"]?> Ekle</li>		
		<?php }elseif($file=="edit"){ ?>
			<li><a href="?s=display&dispatch=<?=$module?>.list"><?=$modules[$module]["title"]?></a> <span class="divider"><div class="icon icon-chevron-right"></div></span></li>
			<li class="active"><?=$modules[$module]["key"]?> Düzenle</li>		
		<?php } ?>
	<?php } ?>
</ul>
