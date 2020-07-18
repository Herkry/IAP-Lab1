<?php
//making sure the page is secure
session_start();
if(!isset($_SESSION["username"])){
    header("Location:http://localhost/IAP-Lab1/Lab1/login.php");
}
//$userId = $_SESSION["userId"];
$userId = 1;
$userName

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Bootstrap mine-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >

    <script>
        $(document).ready(function(){
            $("#btn_place_order").click(function(event){
                alert("Place order?");
                event.preventDefault();
                
                //receive all variables
                name_of_food = $("#name_of_food").val();
                var number_of_units = $("#number_of_units").val();
                var unit_price = $("#unit_price").val();
                var order_status = $("#status").val();
                var userId = $("#userId").val();
            });

            //remeber you'll communicate with the api if you have the API
            //You go to the API sytem and generate your API key
            //we now build an http post request and we send it using ajax
            $.ajax({
                url:"http://localhost/IAP-Lab1/Lab1/api/v1/orders/index.php", //url to our resource
                type:"post",
                data:{
                        name_of_food:name_of_food, 
                        number_of_units:number_of_units, 
                        unit_price:unit_price, 
                        order_status:order_status,
                        userId:userId
                },
                headers:{
                    "Authorization":"Basic qo9zHmerbnsejcksncmkc3we7cw4cjlc3wjcwc"
                },
                success:function(data){
                    alert(data["message"]);
                },
                error:function(){
                    alert("An Error occurred");
                }
            });
        });
    </script>

</head>
<body>
    <h3>It is time to communicate with the exposed API, all we need is the API key to be passed in thr header</h3>
    <hr>
    <h4>Feature 1- Placing an Order</h4>
    <hr>
    <form name="order_form" id="order_form">
        <fieldset>
            <legend>Place Order</legend>
            <input type="text" name="name_of_food" id="name_of_food" required placeholder="Name of Food"><br>
            <input type="number" name="number_of_units" id="name_of_food" required placeholder="Number of Units"><br>
            <input type="number" name="unit_price" id="unit_price" required placeholder="Unit Price"><br>
            <input type="hidden" name="status" id="status" required placeholder="status" value="order_placed"><br>
            <input type="hidden" name="userId" value="<?php echo($userId); ?>">
            <button id="btn_place_order" name="btn_place_order" class="btn btn-warning" type="submit">Place Order</button>
        </fieldset>
    </form>
    <hr>
    <h4>Feature 2- Checking Order Status</h4>
    <form name="order_status_form" id="order_status_form" method="POST", action="index.php">
        <fieldset>
            <legend>Check Order Status</legend>
            <input type="number" name="order_id" id="order_id" required placeholder="Order ID"><br>
            <input type="hidden" name="userId" value="<?php echo($userId); ?>">
            <button id="btn-check-order-status" class="btn btn-warning" type="submit">Check Order Status</button>
        </fieldset>
    </form>

</body>

<!-- Bootstrap mine --> 
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<!-- <script src = "https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.7/js/tether.js"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
</html>