<?php
    require_once("../connect.php");

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

    $pdo_statement = $pdo_conn->prepare("SELECT * FROM `projects_domain`");
    $pdo_statement->execute();
    $result = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $key => $project) {
        $http_code = getStatus($project['url']);

        $status_update = 1;
        if ($http_code != 200 && $http_code != 302) {
            $status_update = 0;
        }

        if ($result[$key]['status'] != $status_update) {
            $result[$key]['status'] = $status_update;
            $id_update = $project['id'];
            $change_time_update = date('Y-m-d H:i:s');
            $pdo_statement_update = $pdo_conn->prepare("UPDATE `projects_domain` SET status=$status_update, change_time=$change_time_update WHERE id=$id_update");
            $pdo_statement_update->execute([$status, $change_time, $id]);

        }
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($result);
    exit;
?>