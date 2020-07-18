<?php
    //include DBConnector.php
    include_once "DBConnector.php";
    //making sure the page is secure
    session_start();
    if(!isset($_SESSION["username"])){
        header("Location:login.php");
    }
    //declare api_key session var
    $_SESSION["api_key"] = "none";

    function fetchUserApiKey(){
        $con = new DBConnector();
        $sql = "SELECT * FROM  api_keys";
		$res = mysqli_query($con->returnConn(), $sql) or die("Error" .mysqli_connect_error());
		while($row = mysqli_fetch_assoc($res)) {
			if($row["user_id"] == $_SESSION["userId"]){
			    $_SESSION["api_key"] = $row["api_key"];
			}
		}
		//close connection
		$con->closeDatabase();
    }

    if(isset($_POST["go_to_api"])){
		header("Location: http://localhost/IAP-Lab1/IAP-Lab1-ExternalApp/index.php");
	}

?>

<html lang="en">
<head>
    <title>Document</title>

    <!-- Review this below (might want to update version) -->
    <!-- <script src="jquery-3.1.1.min.js"></script> -->

    <!-- <script type="text/javascript" src="validate.js"></script>
    <script type="text/javascript" src="apikey.js"></script> -->
    <link rel="stylesheet" type="text/css" href="validate.css">

    <!-- Bootstrap mine-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >

    <!-- Bootstrap file -->
    <!-- js -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script >
        $(document).ready(function(){
            $("#api_key_btn").click(function(event){
                //alert("Hello World");
                var confirm_key = confirm("You are about to generate a new API key");
                if(!confirm_key){
                    return;
                }
                $.ajax({
                    //url:"/IAP-Lab1/Lab1/api/v1/orders/apikey.php",
                    url:"http://localhost/IAP-Lab1/Lab1/api/v1/orders/apikey.php",
                    //url:"apikey.php",
                    type: "post",
                    success: function(data){
                        //if(data["success"] == 1){
                            //everything went fine
                            //set your key in the text area
                            //$("#api_key").val(data["message"]);
                            alert("API Key generated");

                        //}
                        //else{
                            //alert("Something went wrong. Please try again");
                        //}
                    }
                });
            });
        });
    </script>


    <!-- css -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css.map">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css.map">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css.map">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css.map">

</head>
<body>
    <p>This is a private page</p>
    <p>We want to protect it</p>
    <p>Generate API key, then proceed to API by clicking button Go To API</p>
    <p align="right"><a href="logout.php">Logout</a></p>
    <hr>
    <h3>Here we create an API that will allow Users/Developers to order items from external systems</h3>
    <hr>
    <h4>We now put the feature of allowing Users to generate an API key. Click button to generate the API key</h4>
    <button class="btn-btn-primary" id="api_key_btn" name="api_key_btn" onclick>Generate API key</button>
    <!-- This text area will hold the API key -->
    
    <strong>Your API key</strong>(Note that if your API key is already in use by already running applications,generating a new key will stop the application from functioning)<br>
    <?php 
        fetchUserApiKey();
        if($_SESSION["api_key"] == "none"){
    ?>
            <textarea cols="100" row="2" name="api_key" id="api_key" cols="30" rows="10" readonly></textarea>
    <?php
        }
        else{
            $api_key = $_SESSION["api_key"];
    ?>
            <textarea cols="100" row="2" name="api_key" id="api_key" value="<?php echo($api_key); ?>" cols="30" rows="10" readonly></textarea>

    <?php

        }
    ?>
    
    <h3>Service Description</h3>
     We have a service/API that allows external applications to order food and also pull all order status by using order id. Let's do it.
    <hr> 

    <form method="post" action="private_page.php">
        <tr>
    		<td><button type="submit" name="go_to_api"><strong>Go to API</strong></button></td>
		</tr>
    </form>
</body>

<!-- Bootstrap mine --> 
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<!-- <script src = "https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.7/js/tether.js"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
</html>