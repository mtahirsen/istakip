<?php
class form {

	function email_control($email){
		if(! preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s\'"<>]+\.+[a-z]{2,6}))$#si', $email)){
			$this->message("error","Geçersiz Email Adresi.");
			return false;
		}else return true;
	}

	function selectbox($p=array()){
		if($p["class"]=="") $p["class"] = "form-control";
		echo '<select name="'.$p["name"].'" id="'.$p["id"].'" class="'.$p["class"].'">';
		if($p["first"]!=""){
			echo '<option value="'.$p["first_val"].'">'.$p["first"].'</option>';
		}
		if($p["type"]=="array"){
			foreach($p["source"] as $key=>$val){
				if($p["checked"]==$key) $checked = 'selected="selected"'; else $checked = '';
				echo '<option value="'.$key.'" '.$checked.'>'.$val.'</option>';
			}
		}elseif($p["type"]=="sql"){
			$table = $p["table"];
			if($p["cond"]!="") $cond = "WHERE ".$p["cond"];
			if($p["order"]!="") $order = "ORDER BY ".$p["order"];
			if($p["limit"]!="") $limit = "LIMIT ".$p["limit"];
			$list_query = "SELECT * FROM $table $cond $order $limit";
			$list_query = mysql_query($list_query);
			while($list = mysql_fetch_assoc($list_query)){
				if($p["checked"]==$list[$p["list_val"]]) $checked = 'selected="selected"'; else $checked = '';
				echo '<option value="'.$list[$p["list_val"]].'" '.$checked.'>'.$list[$p["list"]].'</option>';		
			}
		}
		echo '</select>';
	}

	function radio_button($p=array()){
		if($p["label_wp_class"]=="") $p["label_wp_class"] = "radio inline";
		if($p["span_class"]=="") $p["span_class"] = "lbl";
		if($p["input_class"]=="") $p["input_class"] = "px";
		echo '<div class="'.$p["wrapper_class"].'" id="'.$p["wrapper_id"].'">';
		if($p["type"]=="array" || $p["type"]==""){
			foreach($p["source"] as $key=>$val){
				if($p["checked"]==$key) $checked = 'checked="checked"'; else $checked = '';
				echo '<div class="'.$p["label_wp_class"].'"><label class="'.$p["label_class"].'"> <input class="'.$p["input_class"].'" type="radio" name="'.$p["name"].'" value="'.$key.'" '.$checked.'> <span class="'.$p["span_class"].'">'.$val.'</span></label></div>';
			}
		}elseif($p["type"]=="sql"){
			$table = $p["table"];
			if($p["cond"]!="") $cond = "WHERE ".$p["cond"];
			if($p["order"]!="") $order = "ORDER BY ".$p["order"];
			if($p["limit"]!="") $limit = "LIMIT ".$p["limit"];
			$list_query = "SELECT * FROM $table $cond $order $limit";
			$list_query = mysql_query($list_query);
			while($list = mysql_fetch_assoc($list_query)){
				if($p["checked"]==$list[$p["list_val"]]) $checked = 'checked="checked"'; else $checked = '';
				echo '<div class="'.$p["label_wp_class"].'"><label class="'.$p["label_class"].'"> <input class="'.$p["input_class"].'" type="radio" name="'.$p["name"].'" value="'.$list[$p["list_val"]].'" '.$checked.'> <span class="'.$p["span_class"].'">'.$list[$p["list"]].'</span></label></div>';
			}
		}
		echo '</div>';
	}

	function checkbox_button($p=array()){
		echo '<div class="'.$p["wrapper_class"].'" id="'.$p["wrapper_id"].'">';
		if($p["type"]=="array"){
			foreach($p["source"] as $key=>$val){
				if($p["checked"]==$key) $checked = 'checked="checked"'; else $checked = '';
				echo '<label class="'.$p["label_class"].'"> <input class="'.$p["input_class"].'" type="checkbox" name="'.$p["name"].'" value="'.$key.'" '.$checked.'> <span>'.$val.'</span></label>';
			}
		}elseif($p["type"]=="sql"){
			$table = $p["table"];
			if($p["cond"]!="") $cond = "WHERE ".$p["cond"];
			if($p["order"]!="") $order = "ORDER BY ".$p["order"];
			if($p["limit"]!="") $limit = "LIMIT ".$p["limit"];
			$list_query = "SELECT * FROM $table $cond $order $limit";
			$list_query = mysql_query($list_query);
			while($list = mysql_fetch_assoc($list_query)){
				if($p["checked"]==$list[$p["list_val"]]) $checked = 'checked="checked"'; else $checked = '';
				echo '<label class="'.$p["label_class"].'"> <input class="'.$p["input_class"].'" type="checkbox" name="'.$p["name"].'" value="'.$list[$p["list_val"]].'" '.$checked.'> <span>'.$list[$p["list"]].'</span></label>';
			}
		}
		echo '</div>';
	}
	
	function error_message($message){
		return '<div class="alert alert-danger">'.$message.'</div>';
	}

	function empty_control($data,$control=array()){
		$error = 0;
		foreach($control as $input=>$val){
			if($error==0){
				if(is_array($val)){
					$input_title = ($val["title"]=="") ? $input : $val["title"];
					if($val["type"]==""){
						if($data[$input]==""){
							$message = $input_title." Boş. <br/>";
							$error = 1;
						}elseif($val["min"]!="" && strlen($data[$input])<$val["min"]){
							$message = $input_title." Karakter sayısı az. Min. ".$val["min"]." Karakter <br/>";
							$error = 1;
						}elseif($val["max"]!="" && strlen($data[$input])>$val["max"]){
							$message = $input_title." Karakter sayısı fazla. Max. ".$val["max"]." Karakter <br/>";
							$error = 1;	
						}elseif($val["email_control"]==true && !$this->email_control($data[$input])){
							$message = "($input_title) Geçersiz Email Adresi ! <br/>";
							$error = 1;
						}
					}elseif($val["type"]=="file"){
						if($_FILES[$input]["name"]==""){
							$message = $input_title." Alanı için dosya yüklemelisiniz. <br/>";
							$error = 1;
						}
					}elseif($val["type"]=="checkbox"){
						if(!isset($data[$input])){
							$message = $input_title." Boş";
							$error = 1;
						}elseif($val["min_check"]!="" && count($data[$input])<$val["min_check"]){
							$message = "($input_title) Min. ".$val["min_check"]." adet seçilmelidir. <br/>";
							$error = 1;						
						}elseif($val["max_check"]!="" && count($data[$input])>$val["max_check"]){
							$message = "($input_title) Max. ".$val["max_check"]." adet seçilmelidir. <br/>";
							$error = 1;						
						}
					}elseif($val["type"]=="number"){
						if($data[$input]==""){
							$message = "$input_title Boş";
							$error = 1;
						}elseif(!is_numeric($data[$input])){
							$message = "$input_title Alanı Numerik Olmalıdır.";
							$error = 1;						
						}elseif($val["min_val"]!="" && $data[$input]<$val["min_val"]){
							$message = "($input_title) Min. ".$val["min_val"]." girilmelidir. <br/>";
							$error = 1;						
						}elseif($val["max_val"]!="" && $data[$input]>$val["max_val"]){
							$message = "($input_title) Max. ".$val["max_val"]." girilmelidir. <br/>";
							$error = 1;						
						}
					}
				}else{
					if($data[$input]==""){
						$input_title = ($val=="") ? $input : $val;
						$message = $input_title." Boş. <br/>";
						$error = 1;
					}
				}
				
				if($message!="" && $error==1){
					echo $this->error_message($message);
				}
				
			}
	
		}
		if($error==1) return false; else return true;
	}
	
	function validator($control,$live=0){
		$valid = '<link rel="stylesheet" href="libs/validator/validator.min.css">';
		$valid .= '<script src="libs/validator/validator.min.js"></script>';
		$valid .= '<script type="text/javascript">';
			$valid .= "\n ".'$(document).ready(function(){ ';
				$valid .= "\n ".'$("form").bootstrapValidator({ ';
					if($live==1) $valid .= "live: 'disabled',";
					$valid .= "\n ".'fields: {';
						$i = 0;
						foreach($control as $input=>$val){
							$i++;
							$input_title = (is_array($val)) ? $val["title"] : $val;
							if($val["type"]=="checkbox") $valid .= "\n '".$input."[]' : { ";
							else $valid .= "\n $input : { ";
							$valid .= 'validators: {';
								if(! is_array($val)) $valid .= "notEmpty: { message: '$input_title Alanı boş bırakılmamalıdır.' }";
								if($val["type"]==""){
									$valid .= "notEmpty: { message: '$input_title Alanı boş bırakılmamalıdır.' }";
									if($val["min"]!="" && $val["max"]!="") $valid .= ", stringLength: { min: ".$val["min"].", max: ".$val["max"].", message: '$input_title Min: ".$val["min"]." / Max: ".$val["max"]." Karakter Almalıdır.'}";
									elseif($val["min"]!="") $valid .= ", stringLength: { min: ".$val["min"].", message: '$input_title Min: ".$val["min"]." Karakter Almalıdır.'}";
									elseif($val["max"]!="") $valid .= ", stringLength: { max: ".$val["max"].", message: '$input_title Max: ".$val["max"]." Karakter Almalıdır.'}";
									if($val["email_control"]==true) $valid .= ", emailAddress: { message: 'Geçersiz Email Adresi' }";
								}elseif($val["type"]=="file"){
									$valid .= "notEmpty: { message: 'Dosya Seçmelisiniz' }";
								}elseif($val["type"]=="checkbox"){
									$valid .= "notEmpty: { message: '$input_title Alanı boş bırakılmamalıdır.' }";
									if($val["min_check"]!="" && $val["max_check"]!="") $valid .= ", choice: { min: ".$val["min_check"].", max: ".$val["max_check"].", message: '$input_title Min: ".$val["min_check"]." / Max: ".$val["max_check"]." Alan Seçilmelidir.'}";
									elseif($val["min_check"]!="") $valid .= ", choice: { min: ".$val["min_check"].", message: '$input_title Min: ".$val["min_check"]." Alan Seçilmelidir.'}";
									elseif($val["max_check"]!="") $valid .= ", choice: { max: ".$val["max_check"].", message: '$input_title Max: ".$val["max_check"]." Alan Seçilmelidir.'}";
								}elseif($val["type"]=="number"){
									$valid .= "notEmpty: { message: '$input_title Alanı boş bırakılmamalıdır.' }";
									$valid .= ", numeric: { message: 'Bu alana yalnızca sayısal değer girilebilir.' }";
								}
							$valid .= " }";
							$valid .= " }";
							if(count($control)!=$i) $valid .= ",";
						}
					$valid .= "\n } ";
				$valid .= "\n }); ";
			$valid .= "\n }); ";
		$valid .= "\n </script>";
		echo $valid;
	}
	
}
?>