$(document).ready(function(){
    $("#btn-check-order-status").click(function(){
        //receive all variables
        var order_id = $("#order_id").val();

        //send input data to server using get
        $.get("http://localhost/IAP-Lab1/Lab1/api/v1/orders/index.php/".order_id, function(data){
            
        //alert user of results
        alert(data["message"]);

        });
    });
});

// $(document).ready(function(){
    // $("#btn-check-order-status").click(function(event){
    //     event.preventDefault();
    //     //receive all variables
    //     var order_id = $("#order_id").val();
        
    // });

    //remeber you'll communicate with the api if you have the API
    //You go to the API sytem and generate your API key
    //we now build an http get request and we send it using ajax
    // $.ajax({
    //     url:"http://localhost/IAP-Lab1/Lab1/api/v1/orders/index.php/".order_id, //url to our resource
    //     type:"post",
        
    //     success:function(data){
    //         alert(data["message"]);
    //     },
    //     error:function(){
    //         alert("An Error occurred");
    //     }
    // });

// });