<?php
	include "crud.php";
	include "authenticator.php";
	include_once "DBConnector.php";

	class User implements Crud, Authenticator{
		private $user_id;
		private $first_name;
		private $last_name;
		private $city_name;

		private $username;
		private $password;

		private $utc_timestamp;
		private $offset;

		private $file_path;

		function __construct($first_name, $last_name, $city_name, $username, $password, $utc_timestamp, $offset, $file_path){
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->city_name = $city_name;

			$this->username =$username;
			$this->password =$password;

			$this->utc_timestamp = $utc_timestamp;
			$this->offset = $offset;

			$this->file_path = $file_path;
		}

		/*Faking static constructor wel will use to login as login does not 
		require all the details required in creting an object
		Method is static so as to be accessed with class rather than object
		NB* All this is being done as PHP does not support multiple constructors
		*/
		public static function create(){
			$instance = new self;
			return $instance;
		}

		//setters and getters
		public function setUTCTimestamp($utc_timestamp){
			$this->utc_timestamp = $utc_timestamp; 
		}

		public function getUTCTimestamp(){
			return $this->utc_timestamp; 
		}

		public function setOffset($offset){
			$this->offset = $offset; 
		}

		public function getOffset(){
			return $this->offset; 
		}
		public function setUsername($username){
			$this->username = $username; 
		}

		public function getUsername(){
			return $this->username; 
		}

		public function setPassword($password){
			$this->password = $password; 
		}

		public function getPassword(){
			return $this->password; 
		}

		public function setUserId($user_id){
			$this->user_id = $user_id; 
		}

		public function getUserId(){
			return $this->user_id; 
		}

		//implementing interface methods
		public function save($con){
			$fn = $this->first_name;
			$ln = $this->last_name;
			$city = $this->city_name;
			$username = $this->username;
			$password = $this->password;
			$utc_timestamp = $this->utc_timestamp;
			$offset = $this->offset;
			$file_path = $this->file_path;

			$res = mysqli_query($con, "INSERT INTO user(first_name, last_name, user_city, username, password, utc_timestmp, offset, filePath) VALUES('$fn', '$ln', '$city', '$username', '$password', '$utc_timestamp', '$offset', '$file_path')") or die("Error: " .mysqli_error($con));
			return $res;
			mysqli_close($con);
		}

		public function readAll($con){
			// return null;
			$sql = "SELECT * FROM  user";
			$result = mysqli_query($con, $sql);
			return $result;

			// if (mysqli_num_rows($result) > 0) {
   //  			// output data of each row
   //  			while($row = mysqli_fetch_assoc($result)) {
   //      			echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
   //  			}
			// } 			
			// else {
   //  			echo "0 results";
			// }
		}
		public function readUnique(){
			return null;
		}
		public function search(){
			return null;
		}
		public function update(){
			return null;
		}
		public function removeOne(){
			return null;
		}
		public function removeAll(){
			return null;
		}
		public function validateForm(){
			//Return true if the values are not empty
			$fn = $this->first_name;
			$ln = $this->last_name;
			$city = $this->city_name;
			$username = $this->username;
			$password = $this->password;

			if($fn == "" || $ln == "" || $city == "" || $username == "" || $password == ""){
				return false;
			}
			//Hash password
			$this->hashPassword();

			return true;
		}
		
		public function createFormErrorSessions(){
			session_start();
			$_SESSION["form_errors"] = "All Fields are required";	
		}

		public function hashPassword(){
			//inbuilt password hash function
			$this->password = password_hash($this->password, PASSWORD_DEFAULT);	
		}

		public function isPasswordCorrect(){
			$con = new DBConnector;
			$found = false;
			

			$sql = "SELECT * FROM  user";
			$res = mysqli_query($con->returnConn(), $sql) or die("Error" .mysqli_connect_error());
			// $res = mysql_query("SELECT * FROM user") or die("Error" .mysqli_connect_error());
			while($row = mysqli_fetch_assoc($res)) {
				if(password_verify($this->getPassword(), $row["password"]) && $this->getUsername() == $row["username"]){
					$found = true;
				}
			}
			//close connection
			$con->closeDatabase();
			return $found;
			
		}
		// public function isPassword(){
		// 	$con = new DBConnector;
		// 	$found = false;
		// 	$foundV = "F";

		// 	$sql = "SELECT * FROM  user";
		// 	$res = mysqli_query($con->returnConn(), $sql) or die("Error" .mysqli_connect_error());
		// 	// $res = mysql_query("SELECT * FROM user") or die("Error" .mysqli_connect_error());
		// 	$passwords = array();
		// 	$count = 0;
		// 	while($row = mysqli_fetch_assoc($res)) {
		// 		$passwords[$count] = $row["password"];
		// 		$count++;
		// 		if(password_verify($this->getPassword(), $row["password"]) && $this->getUsername() == $row["username"]){
		// 			$found = true;
		// 			$foundV = "T";
		// 		}
		// 	}
		// 	//close connection
		// 	$con->closeDatabase();
		// 	return $foundV;
			
		// }

		
		public function login(){
			if($this->isPasswordCorrect()){
				//password is correct, load protected page
				header("Location:private_page.php");
			}
		}
		
		public function createUserSession(){
			session_start();
			//storing username
			$_SESSION["username"] = $this->getUsername();
			//storing user id
			$userName = $this->getUsername();
			$sql = "SELECT id FROM  user WHERE username = '$userName'";
			$res = mysqli_query($con->returnConn(), $sql) or die("Error" .mysqli_connect_error());
			// $res = mysql_query("SELECT * FROM user") or die("Error" .mysqli_connect_error());
			while($row = mysqli_fetch_assoc($res)) {
				$_SESSION["userId"] = $row["id"];
			}

		}
		
		public function logout(){
			session_start();
			unset($_SESSION["username"]);
			unset($_SESSION["userId"]);
			session_destroy();
			header("Location:lab1.php");	
		}

		public function isUserExist(){
			$fn = $this->first_name;
			$ln = $this->last_name;
			$city = $this->city_name;
			$username = $this->username;
			$password = $this->password;
			
			$con = new DBConnector;
			$found = false;
			$sql = "SELECT username FROM  user";
			$res = mysqli_query($con->returnConn(), $sql) or die("Error" .mysqli_connect_error());
			// $res = mysql_query("SELECT * FROM user") or die("Error" .mysqli_connect_error());
			while($row = mysqli_fetch_assoc($res)) {
				if($this->getUsername() == $row["username"]){
					$found = true;
				}
			}
			//close connection
			$con->closeDatabase();
			return $found;

		}




	}

?>