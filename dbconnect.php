<?php
$servername = "monitor2.open-cdn.com";
$username = "root";
$password = "dootvazws3e";
$dbname = "server_usages";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
if(!$conn){
	echo "cannot connect to the database";
	exit;
}