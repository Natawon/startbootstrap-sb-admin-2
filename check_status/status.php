<?php
$url= '159.89.204.197:8032/api/';
$ch = curl_init($url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_TIMEOUT,10);
$output = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo $httpcode;
return $httpcode;

?>