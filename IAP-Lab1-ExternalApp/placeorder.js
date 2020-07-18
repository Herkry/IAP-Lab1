$(document).ready(function(){
    $("#btn-place-order").click(function(event){
        event.preventDefault();
        //receive all variables
        var name_of_food = $("#name_of_food").val();
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