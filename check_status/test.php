<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> <!-- jquery (help with javascript) -->
    <title>Document</title>
<style>
#seconds {
  font-size: 5em;}

#minutes {
  font-size: 5em;
}
#colon {
  font-size: 5em;
}
</style>   
</head>
<body>
<label id="minutes">00</label>
<label id="colon">:</label>
<label id="seconds">00</label>

<button id="reset">Reset</button>
    <script type="text/javascript">
       var totalSeconds = 0; // reset this to zero when you reset as below
var secondsLabel = document.getElementById("seconds");
var minutesLabel = document.getElementById("minutes");
document.getElementById("reset").addEventListener("click",resertTimer);

setInterval(setTime, 1000);

function setTime(){
    ++totalSeconds;
    secondsLabel.innerHTML = pad(totalSeconds%60);
    minutesLabel.innerHTML = pad(parseInt(totalSeconds/60));
}

function pad(val){
    var valString = val + "";
    if(valString.length < 2)
    {
        return "0" + valString;
    }
    else
    {
        return valString;
    }
}

// reset() function
function resertTimer(){
    document.getElementById("minutes").innerHTML = "00";
    document.getElementById("seconds").innerHTML = "00";
    totalSeconds = 0
}
    </script>


</body>
</html>