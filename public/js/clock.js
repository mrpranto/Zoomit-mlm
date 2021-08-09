
function showTime(){
    // to get current time/ date.

    const monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    var date = new Date();
    var month = monthNames[date.getMonth()];
    var day = date.getDate();
    var fullYear = date.getFullYear();

    // to get the current hour
    var h = date.getHours();
    // to get the current minutes
    var m = date.getMinutes();
    //to get the current second
    var s = date.getSeconds();
    // AM, PM setting
    var session = "AM";

    //conditions for times behavior
    if ( h == 0 ) {
        h = 12;
    }
    if( h >= 12 ){
        session = "PM";
    }

    if ( h > 12 ){
        h = h - 12;
    }
    m = ( m < 10 ) ? m = "0" + m : m;
    s = ( s < 10 ) ? s = "0" + s : s;

    //putting time in one variable
    var time = month + ", " + day + " " + fullYear + ", " + h + ":" + m + ":" + s + " " + session;
    //putting time in our div
    $('#clock').html(time);
    //to change time in every seconds
    setTimeout( showTime, 1000 );
}
showTime();
