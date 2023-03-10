<?php
include('export.php');
include('inc/header.php');
?>
<title>phpzag.com: Demo Export Data to CSV with Date Filter using PHP</title> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script src="js/datepickers.js"></script>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.11.1/css/all.css">

<style>
.input-daterange input {
  text-align: left;
}
</style>
<?php include('inc/container.php'); ?>
<div class="container">
<h2>Search Data</h2>
<br>
<div class="row">
 <form method="post">
  <div class="input-daterange">
   <div class="col-md-4">
   
	From<input type="text" name="fromDate2" class="form-control" value="<?php echo $_POST["fromDate2"];?>" placeholder="2023-01-01" />
   <input type="hidden" name="fromDate" class="form-control" value="<?php echo $_POST["fromDate2"]; ?>" readonly />

	<!-- <?php echo $startDateMessage2; ?> -->
   </div>
   <div class="col-md-3">
	To<input type="text" name="toDate2" class="form-control" value="<?php echo $_POST["toDate2"]; ?>" placeholder="2023-01-01" />
   <input type="hidden" name="toDate" class="form-control" value="<?php echo $_POST["toDate2"]; ?>" readonly />

	<!-- <?php echo $endDate2; ?> -->
   </div>
  </div>
  <div class="col-md-2"><div>&nbsp;</div>
   <input type="submit" name="export2" value="Search" class="btn btn-info" />
  </div>
  <div class="col-md-2"><div>&nbsp;</div>
   <input type="submit" name="export" value="Export to CSV" class="btn btn-info" />
  </div>
 </form>
 
</div>
<!-- <h2>Export Data</h2>
<div class="row">
 <form method="post">
  <div class="input-daterange">
   <div class="col-md-4">
	From<input type="text" name="fromDate" class="form-control" value="<?php echo date("Y-m-d"); ?>" readonly />
	<?php echo $startDateMessage; ?>
   </div>
   <div class="col-md-3">
	To<input type="text" name="toDate" class="form-control" value="<?php echo date("Y-m-d"); ?>" readonly />
	<?php echo $endDate; ?>
   </div>
  </div>
  <div class="col-md-2"><div>&nbsp;</div>
   <input type="submit" name="export" value="Export to CSV" class="btn btn-info" />
  </div> -->
 </form>
</div>
<div class="row">
	<div class="col-md-8">
		<?php echo $noResult;?>
	</div>
</div>
<br />
<table class="table table-bordered table-striped">
 <thead>
  <tr>
   <th>ID</th>
   <th>Name</th>
   <th>Site_url</th>
   <th>Change_time</th>
   <th>Status</th>
  </tr>
 </thead>
 <tbody>
  <?php
 //getting id from url
 $database_username = 'root';
 $database_password = 'dootvazws3e';
 $pdo_conn = new PDO( 'mysql:host=monitor2.open-cdn.com;dbname=server_usages', $database_username, $database_password ); 
 
 // $id = $_GET['id'];
//   echo $_GET["fromDate2"];
//   echo $_GET["toDate2"];

   // $strKeyword = null;
   // $_GET["fromDate2"] = "2023-01-13";
   // $_GET["toDate2"] =  date("Y-m-d");
   
  
     if(isset($_POST["fromDate2"]) && isset($_POST["toDate2"]))
     { 
      //  $strKeyword = $_GET["fromDate2"]; 
      //  $strKeyword2 = $_Get["toDate2"]; 

       $sql = "SELECT * FROM projects_domain_logs WHERE SUBSTRING(change_time,1,10) >= '".$_POST["fromDate2"]."' AND SUBSTRING(change_time,1,10) <= '".$_POST["toDate2"]."' ORDER BY change_time DESC";
       
      //  SELECT * FROM projects_domain_logs WHERE container_name LIKE '%".$strKeyword."%'";
 
 
     }
 
    $pdo_statement = $pdo_conn->prepare($sql);
    $pdo_statement->execute();
 // $pdo_statement = $pdo_conn->prepare("SELECT * FROM projects_domain WHERE status=$sort");
 // $pdo_statement->execute(array(':id' => $id));
 // $pdo_statement = $pdo_conn->fetchAll();
 $i=0;
  foreach($pdo_statement as $order) {
     $i++;

   echo '
   <tr>
	<td>'."#".'</td>
	<td>'.$order["container_name"].'</td>
	<td>'.$order["site_url"].'</td>
   <td>'.$order["change_time"].'</td>
   <td>';
  if ($order['status']=="1"){ echo  'UP';}
  else { echo  'Down'; } 
  echo '</td>
   </tr>
   ';
     }
  echo $i." "."Item";
  ?>
  
 </tbody>
</table>
</div>
<?php include("inc/footer.php"); ?>