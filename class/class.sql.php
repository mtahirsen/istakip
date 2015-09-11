<?php
class sql {
	
	function __construct(){
		$this->db["SQL_HOST"] = db_host;
		$this->db["SQL_DB"] = db_name;
		$this->db["SQL_USER"] = db_user;
		$this->db["SQL_PASSWORD"] = db_pass;
		$this->mysql_con();
		$this->sql_injection_security();
	}
	
	function message($type,$message,$extra_class=""){
		if($type=='error') echo '<div class="alert alert-danger '.$extra_class.'"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$message.'</div>';
		else if($type=='success') echo '<div class="alert alert-success '.$extra_class.'"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$message.'</div>';
		else if($type=='info') echo '<div class="alert alert-info '.$extra_class.'"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$message.'</div>';
		else if($type=='warning') echo '<div class="alert alert-warning '.$extra_class.'"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$message.'</div>';
		else echo '<div class="alert '.$extra_class.'"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$message.'</div>';
	}

	function __destruct(){
		$this->mysql_cl();
	}
	
	function mysql_con(){
		$this->sql_connect = @mysql_connect($this->db['SQL_HOST'],$this->db['SQL_USER'],$this->db['SQL_PASSWORD']) or die('Database Error');
		@mysql_select_db($this->db['SQL_DB']) or die('Database Error');
		@mysql_query("SET NAMES UTF8");
	}
	
	function mysql_cl(){
		@mysql_close($this->sql_connect);
	}

	function sql_injection_security(){
		$inj = array ('select', 'insert', 'update', 'drop table', 'union', 'null', 'SELECT', 'INSERT', 'DELETE', 'UPDATE', 'DROP TABLE', 'UNION', 'NULL','order by','order  by');
		for ($i = 0; $i < sizeof ($_GET); ++$i){
			for ($j = 0; $j < sizeof ($inj); ++$j){
				foreach($_GET as $gets){
					$gets = strtolower($gets);
					if(preg_match ('/' . $inj[$j] . '/', $gets)){
						$gets = strtolower($gets);
						$temp = key ($_GET);
						$_GET[$temp] = '';
						exit('<iframe title="YouTube video player" width="800" height="600" src="http://www.youtube.com/embed/bzen6iORGIk" frameborder="0" allowfullscreen></iframe>');
						continue;
					}
				}
			}
		}
	}	

	function get_row($table,$columns,$cond,$qw=0){
		$query = "SELECT $columns FROM $table $cond";
		if($qw==1) echo $query;
		$sql = @mysql_query($query);
		$this->rows = @mysql_num_rows($sql);
		if($this->rows!=0){
			return @mysql_fetch_assoc($sql);			
		}else{
			return false;	
		}
	}
	
	function get_data($query,$qw){
		if($qw==1) echo $query;
		$sql = @mysql_query($query);
		$this->rows = @mysql_num_rows($sql);
		if($this->rows!=0){
			return @mysql_fetch_assoc($sql);	
		}else{
			return false;	
		}
	}

	function mysql_add($table, $postData = array()){
		$q = "DESC $table";	$q = @mysql_query($q);	$getFields = array();
		while ($field = @mysql_fetch_array($q)){
			$getFields[sizeof($getFields)] = $field['Field'];				
		}
		$fields = ""; $values = "";
		if(sizeof($getFields)>0){	
			foreach($getFields as $k){
				if (isset($postData[$k])){						
					$postData[$k] = $postData[$k];
					$fields .= "`$k`, ";
					$values .= "'$postData[$k]', ";
				}
			}
			$fields = substr($fields, 0, strlen($fields) - 2);
			$values = substr($values, 0, strlen($values) - 2);
			$insert = "INSERT INTO $table ($fields) VALUES ($values)"; //echo $insert;	
			if(@mysql_query($insert)){
				if(@mysql_insert_id()){
					$this->insert_id = @mysql_insert_id();
				}
				return true;
			}else return false;
		}else return false;
	}

	function mysql_edit($table, $postData = array(), $kosul){
		$q = "DESC $table"; $q = mysql_query($q); $getFields = array();
		while($field = mysql_fetch_array($q)){
			$getFields[sizeof($getFields)] = $field['Field'];
		}
		$values= ""; $conds = "";
		if(sizeof($getFields)>0){
			foreach($getFields as $k){
				if (isset($postData[$k])){		
					$postData[$k] = $postData[$k];
					$values .= "`$k` = '$postData[$k]', ";
				}
			}
			$values = substr($values, 0, strlen($values) - 2);
			$update = "UPDATE $table SET $values $kosul";  // echo "<pre style='color:red;'>$update</pre>";
			$this->dbResult = mysql_query($update);		
			if($this->dbResult) return true;
			else return false;
		}else return false;
	}
	
	function quick_add($table,$data,$success='',$error=''){
		$error = false;
		if($error==false and $this->mysql_add($table,$data)){
			if($success=='' and $success!='no') $this->message("success","Kayıt başarıyla eklendi."); elseif($success!="no") $this->message("success",$success);
			return true;
			unset($v);
		}else{
			if($error=='' and $error!='no') $this->message("error","Kayıt Eklenemedi.".mysql_error()); elseif($error!="no") $this->message("error",$error); 
			return false;
			extract($v);
		}
	}

	function quick_edit($table,$cond,$data,$success='',$error=''){
		$error = false;
		if($error==false and $this->mysql_edit($table,$data,$cond)){
			if($success=='' and $success!='no') $this->message("success","Kayıt başarıyla güncellendi."); elseif($success!="no") $this->message("success",$success);
			return true;
			unset($v);
		}else{
			if($error=='' and $error!='no') $this->message("error","Kayıt Güncellenemedi.".mysql_error()); elseif($error!="no") $this->message("error",$error); 
			return false;
			extract($v);
		}
	}
	
}
?>