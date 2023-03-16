<?php
require_once("connect.php");

// Generated @ codebeautify.org
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.digitalocean.com/v2/droplets');
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




$data = json_decode($result, TRUE);
$test = json_decode(file_get_contents($result));

// print_r($result);


$i=0;
// unset($file);//prevent memory leaks for large json.
//insert data here
foreach($data['droplets'] as $key=>$value) {
	
		foreach ($value as $key2 => $value2) {
	
			$data2[] = $value2;


            
			// print_r($data2);
			// echo $key2;
			// // unset($key2);	
		}

// echo "<pre>";
// print_r($data['droplets']);

// print_r($key);
// echo "</pre>";


    }


    $i = 0;
    $len = count($data['droplets']);

    // print_r($len);
    foreach ($data['meta'] as $key=>$item) {

        // $result = substr($item['date'],0,4);
        // $last_data = end($item);

        
            // echo "invoice_uuid: " . $item['invoice_uuid'] . "<br>";
            // echo "Amount : " . $item->meta . "<br>";
            // echo "Invoice ID: " . $item['invoice_id'] . "<br>";
            // echo "Invoice UUID: " . $item['invoice_uuid'] . "<br>";
            // echo "Date: " . $item['date'] . "<br>";
            // echo "ip_address: " . $item['ip_address'] . "<br>";
            $total =  $item;
            //  echo "key: " . $key . "<br>";
            //  echo "item: " . $item . "<br>";

            // echo 'Your key is: '.$key.' and the value of the key is:'.$item->id;



            $query = "INSERT INTO droplet (total) VALUES (:total)";
            $query_run = $pdo_conn->prepare($query);
        
            $data = [
                ':total' => $total,
            ];
            $query_execute = $query_run->execute($data);


        
    }
    //  echo "จำนวนเครื่องทั้งหมด".$i;

//     $json = '{"1":"a","2":"b","3":"c","4":"d","5":"e"}';
//  $obj = json_decode($json, TRUE);

// foreach($obj as $key => $value) 
// {
// echo 'Your key is: '.$key.' and the value of the key is:'.$value;
// }
?>