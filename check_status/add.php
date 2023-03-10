<?php
if(!empty($_POST["add_record"])) {
	require_once("connect.php");
	$sql = "INSERT INTO uptime_status ( name, status ) VALUES ( :name, :status )";
	$pdo_statement = $pdo_conn->prepare( $sql );
		
	$result = $pdo_statement->execute( array( ':name'=>$_POST['name'], ':status'=>$_POST['status'] ) );
	if (!empty($result) ){
	  header('location:up2.php');
	}
}
?>
<html>
<head>
<title>PHP PDO CRUD - Add New Record</title>
<style>
body{width:615px;font-family:arial;letter-spacing:1px;line-height:20px;}
.button_link {color:#FFF;text-decoration:none; background-color:#428a8e;padding:10px;}
.frm-add {border: #c3bebe 1px solid;
    padding: 30px;}
.demo-form-heading {margin-top:0px;font-weight: 500;}	
.demo-form-row{margin-top:20px;}
.demo-form-field{width:300px;padding:10px;}
.demo-form-submit{color:#FFF;background-color:#414444;padding:10px 50px;border:0px;cursor:pointer;}
</style>
</head>
<body>
<div style="margin:20px 0px;text-align:right;"><a href="index.php" class="button_link">Back to List</a></div>
<div class="frm-add">
<h1 class="demo-form-heading">Add New Record</h1>
<form name="frmAdd" action="" method="POST">
  <div class="demo-form-row">
	  <label>name: </label><br>
	  <input type="text" name="name" class="demo-form-field" required />
  </div>
  <div class="demo-form-row">
	  <label>status: </label><br>
	  <textarea name="status" class="demo-form-field" rows="5" required ></textarea>
  </div>
  <!-- <div class="demo-form-row">
	  <label>Date: </label><br>
	  <input type="date" name="post_at" class="demo-form-field" required />
  </div> -->
  <div class="demo-form-row">
	  <input name="add_record" type="submit" value="Add" class="demo-form-submit">
  </div>
  </form>
</div> 
</body>
</html>