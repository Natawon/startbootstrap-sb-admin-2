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
	 header("Location:login.php");
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
<?php
session_start();
include('Net/SSH2.php');

$get = $_POST['script'];
$ip = $_POST['ip'];
$password = $_POST['password'];
$name = $_POST['name'];
$url = $_POST['url'];

// $ip ="165.22.58.169";
// $name ="mea";
$ssh = new Net_SSH2($ip);
if (!$ssh->login('root', $password)) {
    exit('Login Failed');
}

echo $ssh->exec("/data/utils/check-web.sh '$name'");
// echo $ssh->exec('ls -la');

header( "refresh: 3;url = http://monitor2.open-cdn.com:8003/manage-service/index.php" );
exit(0);
?>