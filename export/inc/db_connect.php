<?php

/* Database connection start */
$servername = "monitor2.open-cdn.com";
$username = "root";
$password = "dootvazws3e";
$dbname = "server_usages";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
//print_r($conn);
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

?>
