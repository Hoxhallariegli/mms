<?php 
	include "dbconfig.php";
	include "crud.php";
	class Login extends Crud{
		protected $db;
		public function __construct(){
			$this->db = new Crud();
			$this->db = $this->db->ret_obj();
		}	
		public function check_login($emailusername, $password){
		
        $password = md5($password);
		$result = $this->db->query("select user, password, Tipi from login WHERE user='$emailusername' and password='$password'");
		$user_data = $result->fetch_array(MYSQLI_ASSOC);
		$count_row = $result->num_rows;
		$ip_addr = $_SERVER['REMOTE_ADDR']; 	
		if ($count_row == 1) {
	            $_SESSION['login'] = true; // this login var will use for the session thing
	            $_SESSION['Ferid'] = $user_data['user'];
	            $_SESSION['Access'] = $user_data['Tipi'];
				
				$q1 = "INSERT INTO `login_logs`(`username`, `data_ora`, `gjendja`, `ip`)  VALUES ('$emailusername',NOW(),'ok','$ip_addr')";
				$res123 = $this->db->query($q1) or die($this->db->error);          
	            return true;
	        }else{
				
				$q2 = "INSERT INTO `login_logs`(`username`, `data_ora`, `gjendja`, `ip`)  VALUES ('$emailusername',NOW(),'login deshtoi',$ip_addr')";
				$res1234 = $this->db->query($q2) or die($this->db->error);  
			return false;
		}
		

	}
	
	/*** starting the session ***/
	public function get_session(){
	    return $_SESSION['login'];
	    }

	public function user_logout() {
	    $_SESSION['login'] = FALSE;
		unset($_SESSION);
	    session_destroy();
	   }	
}
?>