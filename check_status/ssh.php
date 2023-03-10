<?php
include('NET/SSH.php');


$ssh = new Net_SSH2('165.22.58.169');
if (!$ssh->login('root', 'VRThefrog123s')) {
    exit('Login Failed');
}

// echo $ssh->exec('/data/utils/check-web.sh mea');
echo $ssh->exec('ls -la');
?>