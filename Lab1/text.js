// Returns the number of minutes ahead or behind greenwitch meridian
var offset = new Date().getTimezoneOffset();

//Returns the number of milliseconds since 1970/01/01
var timestamp = new Date().getTime();

//We convert our time to: Universal Time Coordinated / Universal Time Coordinated Time
var utc_timestamp = timestamp + (60000 * offset);

console.log(offset); 
console.log(timestamp);
console.log(utc_timestamp);
console.log(45);
document.write(offset);
document.write("break");

document.write(timestamp);
document.write("break");

document.write(utc_timestamp);

function getTime(zone, success) {
    var url = 'http://json-time.appspot.com/time.json?tz=' + zone,
        ud = 'json' + (+new Date());
    window[ud]= function(o){
        success && success(new Date(o.datetime));
    };
    document.getElementsByTagName('head')[0].appendChild((function(){
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.src = url + '&callback=' + ud;  
        return s;
    })());
}

getTime('GMT', function(time){
    // This is where you do whatever you want with the time:
    alert(time);
});


