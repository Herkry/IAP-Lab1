<?php
	include_once "DBConnector.php";
	include_once "User.php";
	include_once "FileUploader.php";
	
	$con = new DBConnector;

	if(isset($_POST["btn-save"])){
		$first_name = $_POST["first_name"];
		$last_name = $_POST["last_name"];
		$city = $_POST["city_name"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$utc_timestamp = $_POST["utc_timestamp"];
		$offset = $_POST["time_zone_offset"];

		//File uploads
		$target_file = $_FILES["fileToUpload"];
		//create object for file uploading
		$uploader = new FileUploader;
		//call uploadFile() which returns
		$file_upload_response = $uploader->uploadFile($target_file);
		if(!$file_upload_response){
			//Tell user of error in file uploading
			echo("Error uploading file");
			//echo $uploader->status;
		}
		else{
			//All code for inserting to db should be here below
			$file_path = $uploader->getFinalFileName();

			//Declaring User object
			$user = new User($first_name, $last_name, $city, $username, $password, $utc_timestamp, $offset, $file_path);

			if(!$user->validateForm()){
				$user->createFormErrorSessions();
				header("Refresh:0");
				die();
			}
			if($user->isUserExist()){
				echo "Another similar username exists";
			}
			else{
	
				$res = $user->save($con->returnConn());
				if($res){
					echo "Save operation was successful. Click button VIEW DATABASE INFO to see your credentials, then click Login to login and continue";
				}
				else{
					echo "An error occured";
				}
			}
		}		
	}

	if(isset($_POST["btn-view_info"])){
		$user = new User("anonymous", "anonymous", "anonymous", "anonymous", "anonymous", "anonymous", "anonymous", "anonymous");
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
			<script type="text/javascript" src="validate.js"></script>
			<link rel="stylesheet" type="text/css" href="validate.css">

			<!-- include jquery here. I decide to get it from cdn network, Google -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			<!-- Your new js file comes ater including your jquery -->
			<script type="text/javascript" src="timezone.js"></script>
		</head>

		<body>
			<form method="post" enctype="multipart/form-data" name="user_details" id="user_details" onsubmit="return validateForm()" action="">
				<table align="center">
					<tr>
						<td>
							<div id="form_errors">
								<?php
									session_start();
									if(!empty($_SESSION["form_errors"])){
										echo " " .$_SESSION["form_errors"];
										unset($_SESSION["form_errors"]); 
									}
								?>
							</div>
						</td>
					</tr>
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
						<td><input type="text" name="username"  placeholder="Username"></td>
					</tr>
					<tr>
						<td><input type="password" name="password"  placeholder="Password"></td>
					</tr>
					<tr>
						<td>
							<p>You must select a file. Only jpg, jpeg and png files are acceptable. Size should not be greater than 50kb</p>
							Profile Image<input type="file" name="fileToUpload" id="fileToUpload">
						</td>
					</tr>
					<tr>
						<td><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>
					</tr>

					<!-- Create hidden controls to store client UTC date and time zone -->
					<input type="hidden" name="utc_timestamp" id="utc_timestamp" value=""/>
					<input type="hidden" name="time_zone_offset" id="time_zone_offset" value="">
					
					<tr>
						<td><a href="login.php">Login</a></td>
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
