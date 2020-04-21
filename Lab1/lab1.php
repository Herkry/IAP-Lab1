<?php
	include_once "DBConnector.php";
	include_once "User.php";
	$con = new DBConnector;

	if(isset($_POST["btn-save"])){
		$first_name = $_POST["first_name"];
		$last_name = $_POST["last_name"];
		$city = $_POST["city_name"];

		$user = new User($first_name, $last_name, $city);
		$res = $user->save($con->returnConn());

		if($res){
			echo "Save operation was successful";
		}
		else{
			echo "An error occured";
		}
	}

	if(isset($_POST["btn-view_info"])){
		$user = new User("anonymous", "anonymous", "anonymous");
		$result = $user->readAll($con->returnConn());
		// echo($result);
		while($row = mysqli_fetch_assoc($result)) {
        	echo "First Name: " . $row["first_name"]. " <br>Last Name: " . $row["last_name"]. " <br>City: " . $row["user_city"]. "<br><br>";
    	}
	}	

	

?>

<html>
		<head>
			<title>Lab 1</title>
		</head>

		<body>
			<form method="post" action="">
				<table align="center">
					<tr>
						<td><input type="text" name="first_name" required placeholder="First Name"></td>
					</tr>
					<tr>
						<td><input type="text" name="last_name"  placeholder="Last Name"></td>
					</tr>
					<tr>
						<td><input type="text" name="city_name"  placeholder="City"></td>
					</tr>
					<tr>
						<td><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>
					</tr>
					

				</table>
			</form>
			<form method="post" action="">
				<table align="center">
					<tr>
						<td><button type="submit" name="btn-view_info"><strong>VIEW  DATABASE INFO</strong></button></td>
					</tr>
				</table>
			</form>
		</body>	
	</html>
