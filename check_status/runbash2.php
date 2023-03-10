<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();

$get = $_POST['script'];
$ip = $_POST['ip'];
$password = $_POST['password'];
$name = $_POST['name'];
$url = $_POST['url'];

//     echo $get;
/** 
 *  Simple code for executing commands on a remote Linux server via SSH in PHP
 *
 *  @author Phil Kershaw (In collaboration with Philip Mott)
 *
 *  Note: ssh2_connect requires libssh2-php which is a non-standard PHP lib.
 *  Debian: apt-get install libssh2-php
 *  Redhat: yum install libssh2-php ???? I've no idea for redhat, sorry.
 */
// $connection = ssh2_connect('167.71.215.72', 22);
// ssh2_auth_password($connection, 'root', 'VRThefrog123s');

// $stream = ssh2_exec($connection, 'df');
// print_r($stream);


$server = "167.71.215.72";
    //ip address will work too i.e. 192.168.254.254 just make sure this is your public ip address not private as is the example

    //specify your username
    $username = "root";

    //select port to use for SSH
    $po = "VRThefrog123s";

    //command that will be run on server B
    $command = "df";

    //form full command with ssh and command, you will need to use links above for auto authentication help
    $cmd_string = "sshpass -p ".$port." ".$username."@".$server." ".$command;

    //this will run the above command on server A (localhost of the php file)
    exec($cmd_string, $output);

    //return the output to the browser
    //This will output the uptime for server B on page on server A
    echo '<pre>';
    print_r($output);
    echo '</pre>';
// header( "refresh: 3;url = http://monitor2.open-cdn.com:8003/manage-service/index.php" );
// exit(0);

?>