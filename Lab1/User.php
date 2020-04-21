<?php
	include "crud.php";
	class User implements Crud{
		private $user_id;
		private $first_name;
		private $last_name;
		private $city_name;

		function __construct($first_name, $last_name, $city_name){
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->city_name = $city_name;
		}

		//setters and getters
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
			$res = mysqli_query($con, "INSERT INTO user(first_name, last_name, user_city) VALUES('$fn', '$ln', '$city')") or die("Error: " .mysqli_error($con));
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


	}

?>