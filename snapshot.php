<?php
require_once("connect.php");

// Generated @ codebeautify.org
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.digitalocean.com/v2/snapshots?resource_type=volume');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


$headers = array();
$headers[] = 'Accept: application/json';
$headers[] = 'Authorization: Bearer 6791c002a6c3a42203edb8f99395c311e3d53844669cb962b173a43d53b32945';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);


//    print_r($result);


$data = json_decode($result, TRUE);



// unset($file);//prevent memory leaks for large json.
//insert data here
foreach($data['snapshots'] as $key=>$value) {
	
		foreach ($value as $key2 => $value2) {
	
			$data2[] = $value2;

			// print_r($data2);
			// echo $key2;
			// // unset($key2);		
		}

// echo "<pre>";
// print_r($data['meta']);

// print_r($key);
// echo "</pre>";


    }

    $i = 0;
    $len = count($data['snapshots']);
    date_default_timezone_set("Asia/Bangkok");

    
    // print_r($len);
    foreach ($data['snapshots'] as $item) {

        $result = substr($item['date'],0,4);
        $last_data = end($item);
        $date = date('Y-m-d H:i:s');



        //   echo $result;
        // echo $item["amount"]. "<br>";
    // $len = count($data['snapshots']);
    // print_r($len);
    
        // echo "invoice_uuid: " . $item['invoice_uuid'] . "<br>";
        // echo "Amount : " . $item['amount'] . "<br>";
        // echo "Invoice ID: " . $item['invoice_id'] . "<br>";
        // echo "Invoice UUID: " . $item['invoice_uuid'] . "<br>";
        // echo "Date: " . $item['date'] . "<br>";
        // echo "invoice_period: " . $item['invoice_period'] . "<br>";
        // $Amount =  $item['amount'];
        $name =  $item['name'];
        $actual_size =$item['size_gigabytes'];
        $size = $item['min_disk_size'];
       $i++;
    //    echo $i;
        $pdo_statement_update = $pdo_conn->prepare("UPDATE `snapshot` SET actual_size=$actual_size, size=$size, datetime='$date'  WHERE id=$i");
        $pdo_statement_update->execute([$actual_size, $size,$date, $i]);




        $query = "INSERT INTO snapshot_logs (name,actual_size,size) VALUES (:name , :actual_size, :size)";
        $query_run = $pdo_conn->prepare($query);
    
        $data = [
            ':name' => $name,
            ':actual_size' => $actual_size,
            ':size' => $size,
        ];
        $query_execute = $query_run->execute($data);


    
}
?>