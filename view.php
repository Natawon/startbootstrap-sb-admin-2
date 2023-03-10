<?php
// require('timezone.php');
require('dbconnect.php');
//error_reporting(~E_NOTICE);
function start_session()
{
	$_SESSION['user']='';
	session_start();
if(empty($_SESSION['user']))
{
	header("Location:index.php");
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
body{
    background:#F6F6F6;   
}
#ww{
position:relative;
width:1400px;
max-width:100%;
height:350px;
bottom:30px;
}

#tt{
position:relative;
text-align: justify;
max-width:100%;
width:300px;
margin:auto;
height:auto;
right:20%;
top:190px;
height:200px;
}

	/*.avatar {
    vertical-align: middle;
    width: 50px;
    height: 50px;
    border-radius: 50%;
	float:left;
}

.avatar2 {
	position:relative;
    vertical-align: middle;
    width: 50px;
    height: 50px;
    border-radius: 50%;
	float:left;
	top:80px;
	clear:both;
	left:0.1%;
}

.avatar3 {
	position:relative;
    vertical-align: middle;
    width: 50px;
    height: 50px;
    border-radius: 50%;
	float:left;
	top:150px;
	clear:both;
	left:0.1%;
}
#asside{
position:relative;
background-color:#FFF;
box-shadow: 0 2px 10px 0 rgba(1, 1, 1, 0.2);
text-align: justify;
max-width:100%;
width:600px;
margin:auto;
height:auto;
float:left;
top:50px;
}



#side{
position:relative;
background-color:#FFF;
box-shadow: 0 2px 10px 0 rgba(1, 1, 1, 0.2);
text-align: justify;
max-width:100%;
width:800px;
margin:auto;
height:auto;
float:left;
top:10px;
left:1px;
}
*/
#aside{
position:relative;
background-color:#FFF;
box-shadow: 0 2px 10px 0 rgba(1, 1, 1, 0.2);
text-align: justify;
max-width:100%;
width:600px;
margin:auto;
height:auto;
float:left;
top:100px;
left:1px;
border-radius:5px;
box-shadow: 0 5px 10px 0 rgba(1, 1, 1, 0.2);
}
.avatar
{
	position:relative;
    vertical-align: middle;
    width: 100px;
    height:30px;
    border-radius: 90%;
	float:LEFT;
	bottom:80px;
	clear:both;
	right:130px;
	}
</style>
</head>
<body>  
<nav class="navbar navbar-default" role="navigation">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#">activitylog</a>
	</div>
	<div class="collapse navbar-collapse" id="example-navbar-collapse">
		<ul class="nav navbar-nav navbar-right">
		<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-wrench">Settings
		<b class="caret"></span></b></a><!--dropdown menu--->	
		<ul class="dropdown-menu">
		<!--<li class=""><a href="profile.php">Profile settings</a></li>-->
		<li class=""><a href="#">General settings</a></li>
		<li class="divider"></li>
		<li class=""><a href="logout2.php"><span class="glyphicon glyphicon-log-out">Logout</span></a></li>
		</ul>
		</li>
		</ul>
	</div>
</nav>

			<div class="container">
			<div class="row">
			<div class="col-md-8">
			<div class="panel panel-default">
			<div class="panel-body">
			<?php
			$id=$_SESSION['user'];
	$query = $conn->query("SELECT * FROM users inner join activity on users.user_id=activity.user_id where users.user_id='$id'");
	while($roww = $query->fetch())
	{
	$user_id = $roww['user_id'];
	$user_status = $roww['user_status'];
			?>
<?php
echo '<h6>'.'<b>'.'<p class="text-primary">'.$roww['name']
?><br /><p class="page-header">
<?php
echo 'You last login was &nbsp;'.date("d/m/y H:i:sA",strtotime($roww['time_loged']));
?>
<br/><br/><br/>
<?php
	}
?>	
	 </div>                   
	 </div>                   
	 </div> 
	 <div class="col-md-4">
			<div class="panel panel-default">
			<div class="panel-body">
			<?php
			/*$id=$_SESSION['user'];
	$query = $conn->query("SELECT * FROM users inner join activity on users.user_id=activity.user_id where users.user_id='$id'");//left join profile on users.user_id=profile.user_id  ORDER BY post_id DESC");
	while($roww = $query->fetch())
	{
	$user_id = $roww['user_id'];
	$user_status = $roww['user_status'];
			?>
<?php
echo '<h6>'.'<b>'.'<p class="text-primary">'.$roww['user_status']
?><br /><p class="page-header">
<?php
echo 'You last login was &nbsp;'.date("d/m/y H:i:sA",strtotime($roww['time_loged']));
?>
<?php
	}
	*/
$stmt=$conn->prepare( "SELECT * FROM users where user_id=:uid") ;
$stmt->execute(array
('uid'=>$_SESSION['user'])
);
$urow=$stmt->fetch(PDO::FETCH_ASSOC);
$count=$stmt->rowcount();
if($user_status=='online')
{	
echo '<b>'.'<span class="text-success">'." just now".'</span>'.'</b>';
?>
<?php
}
?>	
	 </div>                   
	 </div> 
	 </div> 
	 </div>                   
	 </div>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>  
</html> 
 