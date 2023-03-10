<?php
require_once("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>

  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    div.col-sm-3{
        margin:-1% 2.5%;
        width:20%;
        padding: 25px;

    }
    input{
        color:black;
    }
    
  </style>
</head>
<body>
<?php	
	$pdo_statement = $pdo_conn->prepare("SELECT * FROM uptime_status");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
?>
<?php
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
?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#"></a></li>
        <li><a href="./up.php">UP_STATUS</a></li>
        <li><a href="./dw.php">DOWN_STATUS</a></li>
        <li><a href="#"></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> </a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron">
  <div class="container text-center">
    <h1>Status..</h1>      
    <!-- <p>Some text that represents "Me"...</p> -->
  </div>
</div>

<?php
$url = "http://monitor2.open-cdn.com:8082";
if( !url_test( $url ) ) {
    // echo $website ." is down!";
    echo"<div class='container-fluid bg-3 text-center'>    
    <!-- <h3>Some of my Work</h3><br> -->
    <div class='row'>
      <div class='col-sm-3' style='background-color:red; color:white;'>
        <p>Demo</p>
        <p>http://monitor2.open-cdn.com:8082/</p><br>
        <form method='get' action='./runbash.php'>
        <input type='submit' value='restart service' />       
   </form>
        
      </div>
    </div>
  </div>";
    // echo "<div style='margin-top:-1.5%;margin-left:110px;'><font color='red'>sg-live-11 : down </font></div>";
    // echo "<div style='margin:-1.5% 48%;'><font color='black'>NOTFOUND</font></div>";

} else {
    //   echo $website ." is running.<br>";
  //   echo"<div class='container-fluid bg-3 text-center'>    
  //   <!-- <h3>Some of my Work</h3><br> -->
  //   <div class='row'>
  //     <div class='col-sm-3' style='background-color:green; color:white;'>
  //       <p>Demo</p><br>
  //       <h1>ONLINE</h1>
  //     </div>
  //   </div>
  // </div>";
  echo "<div style='margin:-1.5% 48%;'><font color='black'>NOTFOUND</font></div>";
}
?>
</body>
</html>
