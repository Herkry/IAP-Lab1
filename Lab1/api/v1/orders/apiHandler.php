<?php
include_once "C:/xampp/htdocs/IAP-Lab1/Lab1/DBConnector.php";

class ApiHandler{
    private $meal_name;
    private $meal_units;
    private $unit_price;
    private $status;
    private $user_api_key;
    private $userId;

    //getters and setters
    public function setMealName($meal_name){
        $this->meal_name = $meal_name;
    }
    public function getMealName(){
        return $this->meal_name;
    }
    public function setMealUnits($meal_units){
        $this->meal_units= $meal_units;
    }
    public function getMealUnits(){
        return $this->meal_units;
    }
    public function setUnitPrice($unit_price){
        $this->unit_price = $unit_price;
    }
    public function getUnitPrice(){
        return $this->unit_price;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    public function getStatus(){
        return $this->status;
    }
    public function setUserApiKey($user_api_key){
        $this->$user_api_key = $user_api_key;
    }
    public function getUserApiKey(){
        return $this->$user_api_key;
    }
    public function setUserId($userId){
        $this->$userId = $userId;
    }
    public function getUserId(){
        return $this->$userId;
    }

    public function createOrder(){
        //Saving the incoming order
        $con = new DBConnector();
        $res = mysqli_query($con->returnConn(), "INSERT INTO orders(order_name, units, unit_price, order_status, userId) VALUES('$this->meal_name', '$this->meal_units', '$this->unit_price', '$this->status', '$this->userId')") or die("Error: " .mysqli_error($con->returnConn()));
        return $res;
    }

    public function checkOrderStatus(){
        
        //retrieve order information
        $con = new DBConnector();
        $sql = "SELECT order_status FROM orders WHERE userId = '$this->userId'";
        
		$result = mysqli_query($con->returnConn(), $sql);
		$rowData = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$rowData[]= $row;
		}
		return $rowData;
    }
    public function fetchAllOrders(){

    }
    public function checkApiKey(){
        //code below was for testing
        //return true;

        //retrieve order information
        $con = new DBConnector();
        $sql = "SELECT api_key FROM api_keys WHERE userId = '$this->userId'";
        
		$result = mysqli_query($con->returnConn(), $sql);
		$rowData = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$rowData[]= $row;
        }
        if($rowData[0]["api_key"] == $this->user_api_key){
            return true;
        }
        else{
            return false;
        }
        
    }
    public function checkContentType(){

    }
    //plus many other functions depending on the api features




}

?>