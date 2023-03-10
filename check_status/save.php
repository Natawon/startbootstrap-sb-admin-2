<html>
<head>
<title>save data</title>
</head>
<body>
<?php
	// ini_set('display_errors', 1);
	// error_reporting(~0);

   $servername = "monitor2.open-cdn.com";
   $username = "root";
   $password = "dootvazws3e";
//    $dbName = "server_usages";
  
//    $conn = new PDO("sqlsrv:server=$serverName ; Database = $dbName", $userName, $userPassword);

// 	$sql = "INSERT INTO projects_domain (id, container_id, title, container_name, storage_videos_actual_size, raid, api_key, secret_key, ip, password, site_url, check_url, change_time, status, order, create_datetime, modify_datetime, script) 
// 		VALUES (?, ?, ?, ?, ?, ?)";
//    $params = array($_POST["txtCustomerID"], $_POST["txtName"], $_POST["txtEmail"], $_POST["txtCountryCode"], $_POST["txtBudget"], $_POST["txtUsed"]);

// 	$stmt = $conn->prepare($sql);
// 	$stmt->execute($params);
	
// 	if( $stmt->rowCount() ) {
// 		 echo "Record add successfully";
// 	}

// 	$conn = null;
try {
    $conn = new PDO("mysql:host=$servername;dbname=server_usages", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO projects_domain (id, title, container_name, ip, password, site_url, check_url, script)
    VALUES ('','".$_POST["name"]."','".$_POST["name"]."','".$_POST["ip"]."','".$_POST["pass"]."','".$_POST["site_url"]."','".$_POST["check_url"]."','".$_POST["script"]."');";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
header( "refresh: 3;url = http://monitor2.open-cdn.com:8003/manage-service/check_status/input.php" );
exit(0);
?>
</body>
</html>