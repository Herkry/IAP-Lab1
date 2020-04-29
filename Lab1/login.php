<?php
    include_once "DBConnector.php";
    include "user.php";
    
    $con = new DBConnector;
    if(isset($_POST["btn-login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        // Using fake object instance
        // $instance = User::create();
        // $instance->setPassword($password);
        // $instance->setUsername($username);

        $fakeUser = new User("fname","lname","city","username","password");
        $fakeUser->setPassword($password);
        $fakeUser->setUsername($username);

        //Using fake object instance
        if(/*$instance->isPasswordCorrect()*/$fakeUser->isPasswordCorrect()){
            //Using fake object instance
            // $instance->login();
            $fakeUser->login();

            //close connection
            $con->closeDatabase();
            //Using fake object instance
            //create a user session
            // $instance->createUserSession();
            $fakeUser->createUserSession();
        }
        else{
            $con->closeDatabase();
            header("Location:lab1.php");
        }
    }
?>

<html lang="en">
<head>
    <title>Document</title>
    <script type="text/javascript" src="validate.js"></script>
    <link rel="stylesheet" type="text/css" href="validate.css">
</head>
<body>
    <!-- This form is to be submitted to self for processing -->
    <form method="post" name="login" id="login" action="">
        <table>
            <tr>
                <td><input type="text" name="username" placeholder="Username" required></td>
            </tr>
            <tr>
                <td><input type="password" name="password" placeholder="Password" required></td>
            </tr>
            <tr>
                <td><button type="submit" name="btn-login"><strong>LOGIN</strong></button></td>
            </tr>
        </table>
    </form>
    
</body>
</html>