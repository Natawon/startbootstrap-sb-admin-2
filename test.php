<?php
$folder_path = '/raid3';

$command = "du -s " . escapeshellarg($folder_path);

$output = shell_exec($command);

$size_in_kb = intval(trim($output));

$size_in_mb = round($size_in_kb / 1024, 2);

echo "Folder size: " . $size_in_mb . " MB";

?>

