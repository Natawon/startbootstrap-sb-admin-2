<?php

    $host = 'monitor2.open-cdn.com';
    $port = 22;
    $username = 'root';
    $password = 'vrthefrog';
  
    $connection = ssh2_connect($host, $port);
    ssh2_auth_password($connection, $username, $password);
  
    $stream = ssh2_exec($connection, 'ls');
    stream_set_blocking($stream, true);
    $output = stream_get_contents($stream);
  
    print_r($output);
  
?>