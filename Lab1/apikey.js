$(document).ready(function(){
    $("#api_key_btn").click(function(event){
        alert("Hello World");
        var confirm_key = confirm("You are about to generate a new API key");
        if(!confirm_key){
            return;
        }
        $.ajax({
            url:"http://localhost/IAP-Lab1/Lab1/api/v1/orders/apikey.php",
            type: "post",
            success: function(data){
                if(data["success"] == 1){
                    //everything went fine
                    //set your key in the text area
                    $("#api_key").val(data["message"]);
                    alert("API Key generated");

                }
                else{
                    alert("Something went wrong. Please try again");
                }
            }
        });
    });
});