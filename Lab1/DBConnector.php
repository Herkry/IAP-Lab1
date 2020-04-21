<?php
	define("DB_SERVER", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "icslab1");

	class DBConnector{
		public $conn;

		function __construct(){
			$this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Error:" .mysqli_connect_error());
			// mysql_select_db(DB_NAME, $this->conn);
		}

		public function closeDatabase(){
			mysqli_close($this->conn);
		}

		public function returnConn(){
			return $this->conn;
		}


	}

?>