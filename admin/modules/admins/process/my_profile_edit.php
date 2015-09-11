<?php
if($_POST){
	if(! $core->advanced_empty_control($_POST,$empty)){
		if($_POST["new_password"]!="") $_POST["password"] = $core->password($_POST["new_password"]);
		$username_dedect = $core->get_row("admins","*","WHERE id!='".$online_admin["id"]."' AND username='".$_POST["username"]."'");
		if($username_dedect){
			$core->message("error","Bu kullanıcı Adı Daha Önce Kaydedilmiş.");
		}else{
		
			if($_FILES["image"]["name"]!=""){
				$file_name = "avatars_".$core->file_name($_FILES["image"]["name"]);
				$file_type = strtolower(strrchr($_FILES["image"]["name"],"."));

				$thumbs = array(
					array("width"=>120, "height"=>120, "ratio_crop"=>1, "upload_folder"=>"uploads/pictures/", "name_pre"=>"image_",),
				);
				if($core->image_upload("image","uploads/pictures/",$thumbs,$file_name)){
					$_POST["avatar"] = "uploads/pictures/image_".$file_name.$file_type;
					$last_image_delete = 1;
					$image_upload = 1;
				}
			}

			if($core->quick_edit(Module_Table,"WHERE id='".$online_admin["id"]."'",$_POST)){
				if($data["avatar"]!="" && $last_image_delete==1){
					@unlink($data["avatar"]);
					@unlink(str_replace("image_","",$data["avatar"]));
				}
				$core->location("?s=display&dispatch=admins.my_profile");
			}elseif($image_upload==1){
				@unlink($_POST["avatar"]); 
				@unlink(str_replace("image_","",$_POST["avatar"]));
			}
		
		}
	}
}

if($_GET["delete_image"]){
	mysql_query("UPDATE ".Module_Table." SET avatar='' WHERE id='".$online_admin["id"]."'");
	@unlink($data["avatar"]); 
	@unlink(str_replace("image_","",$data["avatar"]));	
}
?>