<?php
session_start();

include_once "apiHandler.php";
include_once "http://localhost/IAP-Lab1/Lab1/DBConnector.php";

$api= new ApiHandler();
if($_SERVER["REQUEST_METHOD"] === "POST"){
    //check api key from the header
    $api_key_correct = false;
    $headers = apache_request_headers();
    $header_api_key = $headers["Authorization"];
    
    //verifying api_key
    $userId = $_POST["userId"];
    $api->setUserId($userId);
    $api->setUserApiKey($header_api_key);
    $api_key_correct = $api->checkApiKey();

    if($api_key_correct){
        //We are creating an order
        $name_of_food = $_POST["name_of_food"];
        $number_of_units = $_POST["number_of_units"];
        $unit_price = $_POST["unit_price"];
        $order_status = $_POST["order_status"];
        $userId = $_POST["userId"];

        //Connect to the database
        $con = new DBConnector();

        //use setters and getters to assign values
        $api->setmealName($name_of_food);
        $api->setmealUnits($number_of_units);
        $api->setUnitPrice($unit_price);
        $api->setStatus($order_status);
        $api->setUserId($userId);
        $res = $api->createOrder();
        if($res){
            //create json and respond
            $response_array = ["success" => 1, "message" => "Order has been placed"];
            header("Content-type: application/json");
            echo json_encode($response_array);
        }
    }
    else{
        $response_array = ["success" => 0, "message" => "Wrong API key"];
        header("Content-type: application/json");
        echo json_encode($response_array);
    }
}
else if($SERVER["REQUEST_METHOD"] === "GET"){
    //Get session userId
    $userId = $_SESSION['userId'];

    //For retrieving order status
    $api2 = new ApiHandler();
    $api2.setUserId($userId);
    $rowOrderStatusData = $api2.checkOrderStatus();


    if($rowOrderStatusData[0] == "order_placed"){
        //create json and respond
        $response_array = ["success" => 1, "message" => "Order status: Order placed"];
        header("Content-type: application/json");
        echo json_encode($response_array);
    }
    if($rowOrderStatusData[0] == "ready"){
        //create json and respond
        $response_array = ["success" => 1, "message" => "Order status: Order is ready"];
        header("Content-type: application/json");
        echo json_encode($response_array);
    }
    else{
        //create json and respond
        $response_array = ["success" => 0, "message" => "Order status: Error occurred. We cannot retrieve your order status at the moment"];
        header("Content-type: application/json");
        echo json_encode($response_array);
    }
}
else{
    //Sorry we're not supporting this for now

}

?>