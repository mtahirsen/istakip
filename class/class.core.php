<?php
class core extends sql {
	
	function module_start($module,$request){
		foreach($request as $type){
			$file = "modules/".$module."/module.".$type;
			if(file_exists($file)){
				if($type=="js") echo '<script src="'.$file.'"></script>';
				elseif($type=="css") echo '<link rel="stylesheet" href="'.$file.'">';
				elseif($type=="php") include($file);
			}
		}
	}
	
	function message($type,$message,$extra_class=""){
		if($type=='error') echo '<div class="alert alert-danger '.$extra_class.'"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$message.'</div>';
		else if($type=='success') echo '<div class="alert alert-success '.$extra_class.'"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$message.'</div>';
		else if($type=='info') echo '<div class="alert alert-info '.$extra_class.'"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$message.'</div>';
		else if($type=='warning') echo '<div class="alert alert-warning '.$extra_class.'"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$message.'</div>';
		else echo '<div class="alert '.$extra_class.'"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$message.'</div>';
	}

	function alert($text){
		echo '<script type="text/javascript">alert("'.$text.'");</script>';
	}

	function password($password){
		return md5(sha1($password));	
	}
		
	function location($url,$time=0){
		if($time>0) echo '<script type="text/javascript">setTimeout(function(){ window.location="'.$url.'"; },'.($time*1000).');</script>';	
		else echo '<script type="text/javascript">window.location="'.$url.'";</script>';	
	}
	
	function parent_location($url,$time=0){
		if($time>0) echo '<script type="text/javascript">setTimeout(function(){ window.parent.location="'.$url.'"; },'.($time*1000).');</script>';	
		else echo '<script type="text/javascript">window.parent.location="'.$url.'";</script>';	
	}
		
	function advanced_empty_control($data,$empty_array){
		$error = false;
		foreach($empty_array as $input=>$title){
			if(! $error){
				if($data[$input]==NULL){
					$field = ($title=="") ? $input : $title;
					$this->message("error",$field." Alanını doldurmalısınız.");
					$error = true;
				}
			}elseif($error) break;
		}
		return $error;
	}
	
	function clear_input($form_id=""){
		if($form_id==""){
			echo '<script type="text/javascript">$("input[type=text],textarea").val("");</script>';	
		}else{
			echo '<script type="text/javascript">$("#'.$form_id.' input[type=text],#'.$form_id.' textarea").val("");</script>';	
		}
	}

	function ndc($date){
		if($date!="0000-00-00" || $date!=""){
			$ex = explode('-',$date);
			$newDate = $ex[2].".".$ex[1].".".$ex[0];
			if($newDate!="..") return $newDate;
		}
	}
	
	function mdc($date){
		if($date!=""){
			$ex = explode('.',$date);
			$newDate = $ex[2]."-".$ex[1]."-".$ex[0];
			return $newDate;
		}
	}
	
	function tr_date($date){
		if($date!='0000-00-00'){
			$ex = explode('-',$date);
			$ay = array (
				"01" => "Ocak",
				"02" => "Şubat",
				"03" => "Mart",
				"04" => "Nisan",
				"05" => "Mayıs", 
				"06" => "Haziran",
				"07" => "Temmuz", 
				"08" => "Ağustos", 
				"09" => "Eylül", 
				"10" => "Ekim", 
				"11" => "Kasım", 
				"12" => "Aralık"
			);
			$newDate = $ay[$ex[1]]." ".$ex[0];
			return $newDate;
		}		
	}
	
	function email_control($email,$no_message=0){
		if(! preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s\'"<>]+\.+[a-z]{2,6}))$#si', $email)){
			if($type!=1) $this->message("error","Geçersiz Email Adresi.");
			return false;
		}else return true;
	}

	function format_bytes($a_bytes){
		if($a_bytes < 1024){
			return $a_bytes .' B';
		}elseif($a_bytes < 1048576){
			return round($a_bytes / 1024,2).' KB';
		}elseif($a_bytes < 1073741824){
			return round($a_bytes / 1048576,2).' MB';
		}elseif($a_bytes < 1099511627776){
			return round($a_bytes / 1073741824,2).' GB';
		}elseif($a_bytes < 1125899906842624){
			return round($a_bytes / 1099511627776,2).' TB';
		}elseif($a_bytes < 1152921504606846976){
			return round($a_bytes / 1125899906842624,2).' PB';
		}elseif($a_bytes < 1180591620717411303424){
			return round($a_bytes / 1152921504606846976,2).' EB';
		}elseif($a_bytes < 1208925819614629174706176){
			return round($a_bytes / 1180591620717411303424,2).' ZB';
		}else{
			return round($a_bytes / 1208925819614629174706176,2).' YB';
		}
	}

	function mprice($price){
		return str_replace(",","",$price);
	}
	
	function image_upload($file,$upload_folder,$thumbs = array(),$new_name){
		require_once 'class/class.upload.php';
		$image = new Upload($_FILES[$file]);
		if($image->uploaded){
			$image->file_new_name_body = $new_name;
			$image->allowed = array ('image/*');
			$image->file_max_size = 5120000;
			$image->Process($upload_folder);
			if($image->processed){
				for($i=0; $i<count($thumbs); $i++){
					$image->file_new_name_body = $new_name;
					$image->allowed = array('image/*');
					$image->image_resize = true;
					if(($thumbs[$i]["height"]!=0 && $thumbs[$i]["width"]!=0) && $thumbs[$i]["ratio_crop"]=="") $image->image_ratio = true;
					if(($thumbs[$i]["height"]!=0 && $thumbs[$i]["width"]!=0) && $thumbs[$i]["ratio_crop"]==1) $image->image_ratio_crop = true;
					if($thumbs[$i]["height"]!=0 && $thumbs[$i]["width"]=="") $image->image_ratio_x = true;
					if($thumbs[$i]["width"]!=0 && $thumbs[$i]["height"]=="") $image->image_ratio_y = true;
					if($thumbs[$i]["height"]!="") $image->image_y = $thumbs[$i]["height"];
					if($thumbs[$i]["width"]!="") $image->image_x = $thumbs[$i]["width"];
					if($thumbs[$i]["watermark"]!="") $image->image_watermark = $thumbs[$i]["watermark"];
					if($thumbs[$i]["name_pre"]!="") $image->file_name_body_pre = $thumbs[$i]["name_pre"];
					$image->Process($thumbs[$i]["upload_folder"]);
					if(! $image->processed) $this->message($image->error,'error','div');
				}
				return true;
			}else{
				$this->message($image->error,'error','div');
				return false;
			}
		}
	}
	
	function file_upload($file,$upload_folder,$new_name){
		require_once 'class/class.upload.php';
		$image = new Upload($_FILES[$file]);
		if($image->uploaded){
			$image->file_new_name_body = $new_name;
			$image->Process($upload_folder);
			if($image->processed){
				return true;
			}else{
				return false;
			}
		}
	}	
	
	function file_name($file_name){
		$file_name = strtolower($file_name);
		$file_type = strrchr($file_name,".");
		$file_name = str_replace($file_type,"",$file_name);
		$file_name = $this->seo_url($file_name);
		$file_name = $file_name."_".date("d.m.Y_h_i_s");
		return $file_name;
	}
	
	function zerofill ($num, $zerofill = 3){
		return str_pad($num, $zerofill, '0', STR_PAD_LEFT);
	}
	
	function line_pre($data){
		echo "<pre>$data</pre>";
	}

	function line_print($data){
		echo "<pre>"; print_r($data); echo "</pre>";
	}
		
	function mailer($who,$mail_username,$mail_password,$mail_host,$mail_port,$subject,$message){
		include_once("libs/mailer/class.phpmailer.php");
		include_once("libs/mailer/class.smtp.php");

		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->Debugoutput = 'html';
		$mail->Host = $mail_host;
		$mail->Port = $mail_port;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->CharSet  ="utf-8";
		$mail->Encoding="base64";

		$mail->Username = $mail_username;
		$mail->Password = $mail_password;

		$mail->setFrom($mail_username);
		$mail->addReplyTo($mail_username);
		$mail->addAddress($who);

		$mail->Subject = $subject;
		$mail->msgHTML($message);
		$mail->AltBody = $subject;

		if(!$mail->send()){
			echo "Mailer Error: " . $mail->ErrorInfo;
			return false;
		}else{
			return true;
		}
	}	

	function seo_url($url){
		$url = trim($url);
		$find = array('<b>', '</b>');
		$url = str_replace ($find, '', $url);
		$url = preg_replace('/<(\/{0,1})img(.*?)(\/{0,1})\>/', 'image', $url);
		$find = array(' ', '&amp;amp;amp;quot;', '&amp;amp;amp;amp;', '&amp;amp;amp;', '\r\n', '\n', '/', '\\', '+', '<', '>');
		$url = str_replace ($find, '-', $url);
		$find = array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ë', 'Ê');
		$url = str_replace ($find, 'e', $url);
		$find = array('í', 'ý', 'ì', 'î', 'ï', 'I', 'Ý', 'Í', 'Ì', 'Î', 'Ï','İ','ı');
		$url = str_replace ($find, 'i', $url);
		$find = array('ó', 'ö', 'Ö', 'ò', 'ô', 'Ó', 'Ò', 'Ô');
		$url = str_replace ($find, 'o', $url);
		$find = array('á', 'ä', 'â', 'à', 'â', 'Ä', 'Â', 'Á', 'À', 'Â');
		$url = str_replace ($find, 'a', $url);
		$find = array('ú', 'ü', 'Ü', 'ù', 'û', 'Ú', 'Ù', 'Û');
		$url = str_replace ($find, 'u', $url);
		$find = array('ç', 'Ç');
		$url = str_replace ($find, 'c', $url);
		$find = array('þ', 'Þ','ş','Ş');
		$url = str_replace ($find, 's', $url);
		$find = array('ð', 'Ð','ğ','Ğ');
		$url = str_replace ($find, 'g', $url);
		$find = array('/[^A-Za-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
		$repl = array('', '-', '');
		$url = preg_replace ($find, $repl, $url);
		$url = str_replace ('--', '-', $url);
		$url = strtolower($url);
		return $url;	
	}

	function seo_link_control($table,$seo,$id=""){
		$seo = trim($seo);
		if($id=="") $seo_query = $this->get_row("seo_links","*","WHERE seo='".$seo."'");
		else $seo_query = $this->get_row("seo_links","*","WHERE seo='".$seo."' AND (field='".$table."' AND releated_id!='".$id."')");
		if($seo_query){
			$this->message("error","Bu seo link daha önce tanımlanmış.");
			return false;
		}else{
			return true;
		}
	}
	
	function seo($get_seo){
		if($get_seo){
			$get_seo = str_replace(".html","",$get_seo);
			$pagination_control = strpos($get_seo,"_");
			if($pagination_control){
				$page_exp = explode("_",$get_seo);
				$this->seo_pager = $page_exp[0];
				$get_seo = $page_exp[1];
			}
			$seo_link = $this->get_row("seo_links","*","WHERE seo='".$get_seo."'");
			if($seo_link){
				$this->seo_field = $seo_link["field"];
				$this->seo_releated_id = $seo_link["releated_id"];
			}
			return $get_seo;
		}
	}	
	
	function strto($to, $str) {
	 
		define('cs', 'utf-8');
	 
		if(!function_exists('rp')):
			function rp($i, $str) {
			
				$B = array('I', 'Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç');
				$k = array('ı', 'ğ', 'ü', 'ş', 'i', 'ö', 'ç');
				$Bi = array(' I', ' ı', ' İ', ' i');
				$ki = array(' I', ' I', ' İ', ' İ');
	 
				if ($i == 1):
					return str_replace($B, $k, $str);
				elseif ($i == 2):
					return str_replace($k, $B, $str);
				elseif ($i == 3):
					return str_replace($Bi, $ki, $str);
				endif;
			}
		endif;
	 
		if(!function_exists('cf')):
			function cf($c = array(), $str) {
				foreach ($c as $cc) {
					$s = explode($cc, $str);
					foreach ($s as $k => $ss) {
						$s[$k] = strto('ucfirst', $ss);
					}
					$str = implode($cc, $s);
				}
				return $str;
			}
		endif;
	 
		if(!function_exists('te')):
			function te() {
				return trigger_error('Lütfen geçerli bir strto() parametresi giriniz.', E_USER_ERROR);
			}
		endif;
	 
		$to = explode('|', $to);
	 
		if($to):
			foreach ($to as $t) {
				if ($t == 'lower'):
					$str = mb_strtolower(rp(1, $str), cs);
				elseif ($t == 'upper'):
					$str = mb_strtoupper(rp(2, $str), cs);
				elseif ($t == 'ucfirst'):
					$str = mb_strtoupper(rp(2, mb_substr($str, 0, 1, cs)), cs) . mb_substr($str, 1, mb_strlen($str, cs) - 1, cs);
				elseif ($t == 'ucwords'):
					$str = ltrim(mb_convert_case(rp(3, ' ' . $str), MB_CASE_TITLE, cs));
				elseif ($t == 'capitalizefirst'):
					$str = cf(array('. ', '.', '? ', '?', '! ', '!', ': ', ':'), $str);
				else:
					$str = te();
				endif;
			}
		else:
			$str = te();
		endif;
	 
		return $str;
	}
	
}
?>