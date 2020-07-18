$(document).ready(function(){
    // Returns the number of minutes ahead or behind greenwitch meridian
    var offset = new Date().getTimezoneOffset();

    //Returns the number of milliseconds since 1970/01/01
    var timestamp = new Date().getTime();

    //We convert our time to: Universal Time Coordinated / Universal Time Coordibnated Time
    var utc_timestamp = timestamp + (60000 * offset);
    $("#time_zone_offset").val(offset); 
    $("#utc_timestamp").val(utc_timestamp); 

    /*ANS*/////////////////////////////////////////////////////
    /*In the preceding 2 lines, we refer to the form elements 
    time_zone_offset and utc_timestamp and set their values to
     offset and utc_timestamp respectively*/
});