<?php
class admin extends core {
	
	function online(){
		$username = $_SESSION["admin_username"];
		$password = $_SESSION["admin_password"];
		$id = $_SESSION["admin_id"];
		if($username!="" && $password!=""){
			$query = mysql_query("SELECT username,password,id FROM admins WHERE username='".$username."' AND password='".$password."' AND id='".$id."'");
			$count = mysql_num_rows($query);
			if($count==1){
			
				$get_online = $this->get_row("admins_online","*","WHERE admin_id='".$id."'");
				if($get_online){
					mysql_query("UPDATE admins_online SET update_time='".date("Y-m-d H:i:s")."' WHERE admin_id='".$id."'");
				}else{
					mysql_query("INSERT INTO admins_online (admin_id,update_time,ip) VALUES ('".$id."','".date("Y-m-d H:i:s")."','".$_SERVER["REMOTE_ADDR"]."')");
				}
				
				$last15 = date("Y-m-d H:i:s", strtotime("-10 Minutes", strtotime(date("Y-m-d H:i:s"))));
				mysql_query("DELETE FROM admins_online WHERE update_time<'".$last15."'");
				return true;
			
			}
			else return false;
		}else return false;
	}
	
	function permission($page,$group_id){
		$per = $this->get_row("admins_groups_permissions","permission","WHERE group_id='".$group_id."' AND page='".$page."'");
		if(! $per) return 1; else return $per["permission"];
	}
	
	function database_backup_control(){
		$last_backup = $this->get_row("database_backups","*","ORDER BY id DESC LIMIT 0,1");
		$today = date("Y-m-d");
		if($this->date_different($today,$last_backup["create_date"])>7){
			$allTables = array();
			$result = mysql_query('SHOW TABLES');
			while($row = mysql_fetch_row($result)){
				 $allTables[] = $row[0];
			}

			foreach($allTables as $table){
				$result = mysql_query('SELECT * FROM '.$table);
				$num_fields = mysql_num_fields($result);

				$return.= 'DROP TABLE IF EXISTS '.$table.';';
				$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
				$return.= "\n\n".$row2[1].";\n\n";

				for($i=0; $i<$num_fields; $i++){
					while($row = mysql_fetch_row($result)){
					   $return.= 'INSERT INTO '.$table.' VALUES(';
						 for($j=0; $j<$num_fields; $j++){
						   $row[$j] = addslashes($row[$j]);
						   $row[$j] = str_replace("\n","\\n",$row[$j]);
						   if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } 
						   else { $return.= '""'; }
						   if ($j<($num_fields-1)) { $return.= ','; }
						 }
					   $return.= ");\n";
					}
				}
				$return.="\n\n";
			}

			$folder = 'uploads/backups/';

			$date = date('m-d-Y-H-i-s', time()); 
			$filename = $folder."db-backup-".$date; 

			$handle = fopen($filename.'.sql','w+');
			fwrite($handle,$return);
			fclose($handle);
			
			mysql_query("INSERT INTO database_backups (author,file,create_date) VALUES ('0','".$filename.".sql','".date("Y-m-d")."')");		
		}
	}
	
}
?>