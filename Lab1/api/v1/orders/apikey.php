<?php
$api_key = null;

//code for the api key
include_once "/IAP-Lab1/Lab1/DBConnector.php";
if($_SERVER["REQUEST_METHOD"] !== "POST"){
    //We do not allow users to visit this page via a URL
    header("HTTP/1.0 403 Forbidden");
    echo "You are forbidden";
}
else{
    $api_key = null;
    $api_key = generateApiKey(64);
    header("Content-type: application/json");
    // our response if a json
    echo generateresponse($api_key);
}
//  this is how we generate a key. But you can device your own method 
//  the parameter str_length determines the length of the key you want.
//  In our case we have chosen 64 characters 
function generateApiKey($str_length){
    //base 62 map
    $chars = "123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

    //get enough randombits for base 64 encoding (and prevent '=' padding)
    //note: +1 is faster than cell
    $bytes = openssl_random_pseudo_bytes(3*$str_length/4+1);
    
    //convert base 64 to base 62 by mapping + and / to something from the base 62 map
    //use the first 2 random bytes for the new characters
    $repl = unpack("C2", $bytes);

    $first = $chars[$repl[1]%62];
    $second = $chars[$repl[2]%62];
    
    return strtr(substr(base64_encode($bytes), 0, $str_length), "+/", "$first$second");
}

function saveApiKey(){
    // Write code that saves api key for the user, 
    // this function returns true if the key saved, 
    // false otherwise
    $con = new DBConnector;
    $user_id = $_SESSION["userId"];
    $res = mysqli_query($con->retrurnConn(), "INSERT INTO api_keys('api_key', 'user_id') VALUES('$api_key', '$user_id')") or die("Error: " .mysqli_error($con));

}

function generateResponse($api_key){
    if(saveApiKey()){
        $res = ["success"=>1, "message"=>$api_key];
    }
    else{
        $res = ["success"=>0, "message"=>"Something went wrong. Please regenerate the API key"];
    }

    return json_encode($res);
}

?>