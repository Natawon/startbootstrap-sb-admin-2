<?php
require_once("connect.php");

// Generated @ codebeautify.org
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.digitalocean.com/v2/customers/my/invoices');
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


//  print_r($result);


$data = json_decode($result, TRUE);



// unset($file);//prevent memory leaks for large json.
//insert data here
foreach($data['invoices'] as $key=>$value) {
	
		foreach ($value as $key2 => $value2) {
	
			$data2[] = $value2;

			// print_r($data2);
			// echo $key2;
			// // unset($key2);		
		}

// echo "<pre>";
// print_r($data['billing_history']);

// print_r($key);
// echo "</pre>";


    }

    $i = 0;
    $len = count($data['invoices']);
    // print_r($len);
    foreach ($data['invoices'] as $item) {

        $result = substr($item['date'],0,4);
        $last_data = end($item);

        //   echo $result;
        // echo $item["amount"]. "<br>";

        if($i == 0){
            // echo "invoice_uuid: " . $item['invoice_uuid'] . "<br>";
            // echo "Amount : " . $item['amount'] . "<br>";
            // echo "Invoice ID: " . $item['invoice_id'] . "<br>";
            // echo "Invoice UUID: " . $item['invoice_uuid'] . "<br>";
            // echo "Date: " . $item['date'] . "<br>";
            // echo "invoice_period: " . $item['invoice_period'] . "<br>";
            $Amount =  $item['amount'];



            $query = "INSERT INTO digitalocean (costs) VALUES (:costs)";
            $query_run = $pdo_conn->prepare($query);
        
            $data = [
                ':costs' => $Amount,
            ];
            $query_execute = $query_run->execute($data);


        }else {
            
            


        }
        $i++;
        
 
        
    }

?>