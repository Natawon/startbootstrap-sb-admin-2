<?php
include_once("inc/db_connect.php");
$query = "SELECT * FROM projects_domain_logs ORDER BY change_time DESC";
$results = mysqli_query($conn, $query) or die("database error:". mysqli_error($conn));
$allOrders = array();
while( $order = mysqli_fetch_assoc($results) ) {
	$allOrders[] = $order;
}
$startDateMessage = '';
$endDate = '';
$startDateMessage2 = '';
$endDate2 = '';

$noResult ='';
if(isset($_POST["export"])){
 if(empty($_POST["fromDate"])){
  $startDateMessage = '<label class="text-danger">Select start date.</label>';
 }else if(empty($_POST["toDate"])){
  $endDate = '<label class="text-danger">Select end date.</label>';
 } else {  
  $orderQuery = "
	SELECT * FROM projects_domain_logs 
	WHERE SUBSTRING(change_time,1,10) >= '".$_POST["fromDate"]."' AND SUBSTRING(change_time,1,10) <= '".$_POST["toDate"]."' ORDER BY change_time DESC";
  $orderResult = mysqli_query($conn, $orderQuery) or die("database error:". mysqli_error($conn));
  $filterOrders = array();
  while( $order = mysqli_fetch_assoc($orderResult) ) {
	$filterOrders[] = $order;
  }
  if(count($filterOrders)) {
	  $fileName = "monitor-service_".date('Ymd') . ".csv";
	  header("Content-Description: File Transfer");
	  header("Content-Disposition: attachment; filename=$fileName");
	  header("Content-Type: application/csv;");
	  $file = fopen('php://output', 'w');
	  $header = array("id", "container_name", "site_url", "change_time", "status");
	  fputcsv($file, $header);  
	  foreach($filterOrders as $order) {
	   $orderData = array();
	   $orderData[] = $order["id"];
	   $orderData[] = $order["container_name"];
	   $orderData[] = $order["site_url"];
	   $orderData[] = $order["change_time"];
	   $orderData[] = $order["status"];
	   fputcsv($file, $orderData);
	  }
	  fclose($file);
	  exit;
  } else {
	 $noResult = '<label class="text-danger">There are no record exist with this date range to export. Please choose different date range.</label>';  
  }
 }
}
?>