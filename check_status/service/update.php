<?php
    require_once("../connect.php");

    $id_update = 1;
    $change_time_update = date('Y-m-d H:i:s');
    $sql = "UPDATE projects_domain SET status=1, change_time='$change_time_update' WHERE id=$id_update";
    $pdo_conn->prepare($sql)->execute([$status, $change_time, $id]);
?>