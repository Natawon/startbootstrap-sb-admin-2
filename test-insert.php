<?php
include('connect.php');



    $query = "INSERT INTO projects_domain_logs (member_id, container_name, ip, site_url,change_time, status) VALUES (:member_id, :container_name, :ip, :site_url, :change_time, :status )";
    $query_run = $pdo_conn->prepare($query);

    $data = [
        ':member_id' => "2",
        ':container_name' => "2",
        ':ip' => "2",
        ':site_url' => "2",
        ':change_time' => "2",
        ':status' => "2",
    ];
    $query_execute = $query_run->execute($data);

    if($query_execute)
    {
        echo "Inserted Successfully";
        
    }
    else
    {
        echo "Not Inserted";
        
    }


?>