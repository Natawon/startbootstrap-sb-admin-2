<?php
// (A) CONNECT TO DATABASE - CHANGE SETTINGS TO YOUR OWN!
$dbHost = "monitor2.open-cdn.com";
$dbName = "server_usages";
$dbChar = "utf8";
$dbUser = "root";
$dbPass = "dootvazws3e";
try {
  $pdo = new PDO(
    "mysql:host=".$dbHost.";dbname=".$dbName.";charset=".$dbChar,
    $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
  );
} catch (Exception $ex) { exit($ex->getMessage()); }
 
// (B) READ UPLOADED CSV
$fh = fopen($_FILES["upcsv"]["tmp_name"], "r");
if ($fh === false) { exit("Failed to open uploaded CSV file"); }
 
// (C) IMPORT ROW BY ROW
while (($row = fgetcsv($fh)) !== false) {
  try {
    // print_r($row);
    $stmt = $pdo->prepare("INSERT INTO `projects_domain` (`title`, `container_name`, `ip`, `password`, `site_url`, `check_url`, `script`) VALUES (?,?,?,?,?,?,?)");
    $stmt->execute([$row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]]);
  } catch (Exception $ex) { echo $ex->getmessage(); }
}
fclose($fh);
echo "DONE.";

header( "refresh: 3;url = http://monitor2.open-cdn.com:8003/check_status/input.php" );
exit(0);
?>