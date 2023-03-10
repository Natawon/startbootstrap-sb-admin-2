<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>monitor</title>
</head>
<body><form method="get" action="/dev/runbash.php">
        <input type="submit" value="restart wowza" />  
    </form>
<?php
/**
 * PHP/cURL function to check a web site status. If HTTP status 
 * is not 200 or 302, or the requests takes longer than 10 
 * seconds, the website is unreachable.
 * 
 * Follow me on Twitter: @HertogJanR
 * Send your donation through https://www.paypal.me/jreilink. Thanks!
 *
 * @param string $url URL that must be checked
 */

function url_test( $url ) {
	$timeout = 10;
	$ch = curl_init();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
	$http_respond = curl_exec($ch);
	$http_respond = trim( strip_tags( $http_respond ) );
	$http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
	if ( ( $http_code == "200" ) || ( $http_code == "302" ) ) {
		return true;
	} else {
		// you can return $http_code here if necessary or wanted
		return false;
	}
	curl_close( $ch );
}


    $url = "https://sg-live-11.open-cdn.com";
if( !url_test( $url ) ) {
    // echo $website ." is down!";
    echo "<div style='margin-top:-1.5%;margin-left:110px;'><font color='red'>sg-live-11 : down </font></div>";

} else {
    //   echo $website ." is running.<br>";
    echo "<div style='margin-top:-1.5%;margin-left:110px;'><font color='green'>sg-live-11 : running </font></div>";
}
//  header("refresh:5;http://localhost:8001/dev/monitor2.php");
?>
</body>
</html>