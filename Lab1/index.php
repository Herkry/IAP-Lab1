<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Bootstrap mine-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >

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
            <input type="number" name="number_of_units" id="" required placeholder="Number of Units"><br>
            <input type="number" name="unit_price" id="unit_price" required placeholder="Unit Price"><br>
            <input type="hidden" name="status" required placeholder="status" value="order_placed"><br>

            <button class="btn btn-warning" type="submit"></button>
        </fieldset>
    </form>
    <hr>
    <h4>Feature 2- Checking Order Status</h4>
    <form name="order_status_form" id="order_status_form" method="POST", action="index.php">
        <fieldset>
            <legend>Check Order Status</legend>
            <input type="number" name="order_id" id="order_id" required placeholder="Order ID"><br>

            <button class="btn btn-warning" type="submit">Check Order Status</button>
        </fieldset>
    </form>

</body>
<!-- Bootstrap mine --> 
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<!-- <script src = "https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.7/js/tether.js"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
</html>