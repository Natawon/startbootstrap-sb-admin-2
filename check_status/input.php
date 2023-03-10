<?php
// require('timezone.php');
require('../dbconnect.php');
//error_reporting(~E_NOTICE);
function start_session()
{
	$_SESSION['user']='';
	session_start();
if(empty($_SESSION['user']))
{
	 header("Location:../login.php");
	exit();
	}
}
echo start_session();
function db_query()
{
	global $conn;
$stmt=$conn->prepare( "SELECT * FROM users where user_id=:uid") ;
if($stmt->execute(['uid'=>$_SESSION['user']]))
{
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    
	$count=$stmt->rowcount();
	       }
	}
	echo db_query();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>input data</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

</head>
<body>
<nav class="navbar navbar-dark bg-dark navbar-expand">
        <!-- <a class="navbar-brand" href="#">FROG GENIUS</a> -->
        <div class="collapse navbar-collapse pl-4" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/manage-service/index.php">Back <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <br>

<div class="container">
  <h2>form data</h2>
  <form action="../check_status/save.php" method="post">
    <div class="form-group">
      <label for="name">Container name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Container name" name="name" required>
    </div>
    <div class="form-group">
      <label for="ip">IP:</label>
      <input type="text" class="form-control" id="ip" placeholder="Enter ip" name="ip" required>
    </div>
    <div class="form-group">
      <label for="pass">pass:</label>
      <input type="password" class="form-control" id="pass" placeholder="Enter Password" name="pass" required>
    </div>
    <div class="form-group">
      <label for="site_url">site_url:</label>
      <input type="text" class="form-control" id="site_url" placeholder="Enter site_url" name="site_url" required>
    </div>
    <div class="form-group">
      <label for="check_url">check_url:</label>
      <input type="text" class="form-control" id="check_url" placeholder="Enter check_url" name="check_url" required>
    </div>
    <div class="form-group">
      <!-- <label for="script">script:</label> -->
      <input type="hidden" class="form-control" id="script" placeholder="Enter Script" name="script" value="bash /data/utils/check-web.sh">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

<div class="container">
<br>
<h3>Uploading multiple data</h3>
<form action="../check_status/import.php" method="post" enctype="multipart/form-data">
  <input type="file" name="upcsv" accept=".csv" required>
  <input type="submit" value="Upload">
</form>
</div>
</body>
</html>
