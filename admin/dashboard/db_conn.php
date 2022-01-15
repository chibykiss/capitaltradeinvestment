<?php
	class connection{
		private $host = 'localhost';
		private $user_name = 'root';
		private $password = '';
		private $db_name = 'bitinvest';

		public function connect(){
			$conn = new mysqli($this->host,$this->user_name,$this->password,$this->db_name);
			/*if($conn){
				echo 'connection sucesss';
			}
			else{
				echo 'connection failed';
			}*/
			return $conn;

		}
	}

	//$try = new connection;
	//$try->conn();
?>