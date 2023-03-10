<?php
    require_once("../connect.php");

    function dateDifference($date_1 , $date_2 , $differenceFormat = '%dd %hh %im %ss' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);

        $interval = date_diff($datetime1, $datetime2);

        return $interval->format($differenceFormat);
    }

    function getStatus($url)
    {
        $timeout = 10;
        $ch = curl_init();

        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_TIMEOUT, $timeout);

        $http_respond = curl_exec($ch);
        $http_respond = trim(strip_tags($http_respond));
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        return $http_code;

        curl_close( $ch );
    }

    $pdo_statement = $pdo_conn->prepare("SELECT * FROM `projects_domain` where status='0'");
    $pdo_statement->execute();
    $result = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $key => $project) {
        $http_code = getStatus($project['check_url']);

        $status_update = 1;
        $id_update = $project['id'];
        if ($http_code != 200 && $http_code != 302) {
            $status_update = 0;
        }else{
            $result[$key]['change_time'] = date('Y-m-d H:i:s');
            $change_time_update = $result[$key]['change_time'];
            $name = $result[$key]['container_name'];
            $ip = $result[$key]['ip'];
            $site_url = $result[$key]['site_url'];

            $query = "INSERT INTO projects_domain_logs (member_id, container_name, ip, site_url,change_time, status) VALUES (:member_id, :container_name, :ip, :site_url, :change_time, :status )";
            $query_run = $pdo_conn->prepare($query);
        
            $data = [
                ':member_id' => $id_update,
                ':container_name' => $name,
                ':ip' => $ip,
                ':site_url' => $site_url,
                ':change_time' => $change_time_update,
                ':status' => $status_update,
            ];
            $query_execute = $query_run->execute($data);
        }

        if ($result[$key]['status'] != $status_update) {
            $result[$key]['status'] = $status_update;
            $result[$key]['change_time'] = date('Y-m-d H:i:s');
            $change_time_update = $result[$key]['change_time'];

            $pdo_statement_update = $pdo_conn->prepare("UPDATE `projects_domain` SET status=$status_update, change_time='$change_time_update' WHERE id=$id_update");
            $pdo_statement_update->execute([$status, $change_time, $id]);
        }

        $result[$key]['status_datetime'] = dateDifference($result[$key]['change_time'], date('Y-m-d H:i:s'));
    }
?>


